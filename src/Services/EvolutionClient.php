<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use WallaceMartinss\FilamentEvolution\Exceptions\EvolutionApiException;

class EvolutionClient
{
    protected string $baseUrl;

    protected string $apiKey;

    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('filament-evolution.api.base_url', ''), '/');
        $this->apiKey = config('filament-evolution.api.api_key', '');
        $this->timeout = config('filament-evolution.api.timeout', 30);
    }

    /**
     * Create base HTTP client with authentication headers.
     */
    protected function client(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->withHeaders([
                'apikey' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])
            ->acceptJson();
    }

    /**
     * Make a request to Evolution API.
     *
     * @throws EvolutionApiException
     */
    protected function request(string $method, string $endpoint, array $data = []): array
    {
        try {
            // Log request for debugging (without base64 content to avoid huge logs)
            $logData = $data;
            if (isset($logData['mediaMessage']['media']) && str_starts_with($logData['mediaMessage']['media'] ?? '', 'data:')) {
                $logData['mediaMessage']['media'] = '[BASE64 CONTENT OMITTED]';
            }

            $response = match (strtoupper($method)) {
                'GET' => $this->client()->get($endpoint, $data),
                'POST' => $this->client()->post($endpoint, $data),
                'PUT' => $this->client()->put($endpoint, $data),
                'DELETE' => $this->client()->delete($endpoint, $data),
                default => throw new EvolutionApiException("Unsupported HTTP method: {$method}"),
            };

            return $this->handleResponse($response);
        } catch (EvolutionApiException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new EvolutionApiException(
                message: "Failed to connect to Evolution API: {$e->getMessage()}",
                previous: $e
            );
        }
    }

    /**
     * Handle API response.
     *
     * @throws EvolutionApiException
     */
    protected function handleResponse(Response $response): array
    {
        $body = $response->json() ?? [];

        if ($response->failed()) {
            $message = $body['message'] ?? $body['error'] ?? 'Unknown API error';

            // Log the full response for debugging
            \Illuminate\Support\Facades\Log::error('Evolution API Error', [
                'status' => $response->status(),
                'body' => $body,
            ]);

            throw new EvolutionApiException(
                message: "Evolution API error: {$message}",
                code: $response->status()
            );
        }

        return $body;
    }

    /**
     * Create a new WhatsApp instance.
     *
     * @throws EvolutionApiException
     */
    public function createInstance(
        string $instanceName,
        ?string $number = null,
        bool $qrcode = true,
        array $options = []
    ): array {
        // Format number (remove all non-digits)
        $formattedNumber = $number ? preg_replace('/\D/', '', $number) : null;

        // Build payload with all instance settings
        $data = [
            'instanceName' => $instanceName,
            'qrcode' => $qrcode,
            'integration' => config('filament-evolution.instance.integration', 'WHATSAPP-BAILEYS'),
            'rejectCall' => (bool) ($options['reject_call'] ?? config('filament-evolution.instance.reject_call', false)),
            'msgCall' => $options['msg_call'] ?? config('filament-evolution.instance.msg_call', ''),
            'groupsIgnore' => (bool) ($options['groups_ignore'] ?? config('filament-evolution.instance.groups_ignore', false)),
            'alwaysOnline' => (bool) ($options['always_online'] ?? config('filament-evolution.instance.always_online', false)),
            'readMessages' => (bool) ($options['read_messages'] ?? config('filament-evolution.instance.read_messages', false)),
            'readStatus' => (bool) ($options['read_status'] ?? config('filament-evolution.instance.read_status', false)),
            'syncFullHistory' => (bool) ($options['sync_full_history'] ?? config('filament-evolution.instance.sync_full_history', false)),
        ];

        if ($formattedNumber) {
            $data['number'] = $formattedNumber;
        }

        // Add webhook configuration
        if (config('filament-evolution.webhook.enabled', true)) {
            $webhookUrl = config('filament-evolution.webhook.url');

            if ($webhookUrl) {
                $data['webhook'] = [
                    'url' => $webhookUrl,
                    'byEvents' => (bool) config('filament-evolution.webhook.by_events', false),
                    'base64' => (bool) config('filament-evolution.webhook.base64', false),
                    'events' => config('filament-evolution.webhook.events', []),
                ];
            }
        }

        return $this->request('POST', '/instance/create', $data);
    }

    /**
     * Connect an existing instance and get QR code.
     *
     * @throws EvolutionApiException
     */
    public function connectInstance(string $instanceName): array
    {
        return $this->request('GET', "/instance/connect/{$instanceName}");
    }

    /**
     * Fetch current QR code for an instance.
     *
     * @throws EvolutionApiException
     */
    public function fetchQrCode(string $instanceName): array
    {
        return $this->request('GET', "/instance/connect/{$instanceName}");
    }

    /**
     * Get instance connection state.
     *
     * @throws EvolutionApiException
     */
    public function getConnectionState(string $instanceName): array
    {
        return $this->request('GET', "/instance/connectionState/{$instanceName}");
    }

    /**
     * Get instance information.
     *
     * @throws EvolutionApiException
     */
    public function fetchInstance(string $instanceName): array
    {
        return $this->request('GET', '/instance/fetchInstances', [
            'instanceName' => $instanceName,
        ]);
    }

    /**
     * Logout from WhatsApp (disconnect but keep instance).
     *
     * @throws EvolutionApiException
     */
    public function logoutInstance(string $instanceName): array
    {
        return $this->request('DELETE', "/instance/logout/{$instanceName}");
    }

    /**
     * Delete an instance completely.
     *
     * @throws EvolutionApiException
     */
    public function deleteInstance(string $instanceName): array
    {
        return $this->request('DELETE', "/instance/delete/{$instanceName}");
    }

    /**
     * Restart an instance.
     *
     * @throws EvolutionApiException
     */
    public function restartInstance(string $instanceName): array
    {
        return $this->request('PUT', "/instance/restart/{$instanceName}");
    }

    /**
     * Set instance settings.
     *
     * @throws EvolutionApiException
     */
    public function setSettings(string $instanceName, array $settings): array
    {
        return $this->request('POST', "/settings/set/{$instanceName}", $settings);
    }

    /**
     * Send a text message.
     *
     * @throws EvolutionApiException
     */
    public function sendText(string $instanceName, string $number, string $text, array $options = []): array
    {
        return $this->request('POST', "/message/sendText/{$instanceName}", array_merge([
            'number' => $number,
            'text' => $text,
        ], $options));
    }

    /**
     * Send an image message.
     *
     * @throws EvolutionApiException
     */
    public function sendImage(
        string $instanceName,
        string $number,
        string $imageUrl,
        ?string $caption = null,
        array $options = []
    ): array {
        $data = [
            'number' => $number,
            'mediatype' => 'image',
            'media' => $imageUrl,
        ];

        if ($caption) {
            $data['caption'] = $caption;
        }

        if (! empty($options)) {
            $data['options'] = $options;
        }

        return $this->request('POST', "/message/sendMedia/{$instanceName}", $data);
    }

    /**
     * Send a video message.
     *
     * @throws EvolutionApiException
     */
    public function sendVideo(
        string $instanceName,
        string $number,
        string $videoUrl,
        ?string $caption = null,
        array $options = []
    ): array {
        $data = [
            'number' => $number,
            'mediatype' => 'video',
            'media' => $videoUrl,
        ];

        if ($caption) {
            $data['caption'] = $caption;
        }

        if (! empty($options)) {
            $data['options'] = $options;
        }

        return $this->request('POST', "/message/sendMedia/{$instanceName}", $data);
    }

    /**
     * Send an audio message.
     *
     * @throws EvolutionApiException
     */
    public function sendAudio(string $instanceName, string $number, string $audioUrl, array $options = []): array
    {
        return $this->request('POST', "/message/sendWhatsAppAudio/{$instanceName}", [
            'number' => $number,
            'audio' => $audioUrl,
        ]);
    }

    /**
     * Send a document.
     *
     * @throws EvolutionApiException
     */
    public function sendDocument(
        string $instanceName,
        string $number,
        string $documentUrl,
        string $fileName,
        ?string $caption = null,
        array $options = []
    ): array {
        $data = [
            'number' => $number,
            'mediatype' => 'document',
            'media' => $documentUrl,
            'fileName' => $fileName,
        ];

        if ($caption) {
            $data['caption'] = $caption;
        }

        if (! empty($options)) {
            $data['options'] = $options;
        }

        return $this->request('POST', "/message/sendMedia/{$instanceName}", $data);
    }

    /**
     * Send a location.
     *
     * @throws EvolutionApiException
     */
    public function sendLocation(
        string $instanceName,
        string $number,
        float $latitude,
        float $longitude,
        ?string $name = null,
        ?string $address = null,
        array $options = []
    ): array {
        $data = array_merge([
            'number' => $number,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ], $options);

        if ($name) {
            $data['name'] = $name;
        }

        if ($address) {
            $data['address'] = $address;
        }

        return $this->request('POST', "/message/sendLocation/{$instanceName}", $data);
    }

    /**
     * Send a contact card.
     *
     * @throws EvolutionApiException
     */
    public function sendContact(
        string $instanceName,
        string $number,
        string $contactName,
        string $contactNumber,
        array $options = []
    ): array {
        return $this->request('POST', "/message/sendContact/{$instanceName}", array_merge([
            'number' => $number,
            'contact' => [
                [
                    'fullName' => $contactName,
                    'wuid' => $contactNumber,
                    'phoneNumber' => $contactNumber,
                ],
            ],
        ], $options));
    }

    /**
     * Set webhook for an instance.
     *
     * @throws EvolutionApiException
     */
    public function setWebhook(string $instanceName, string $url, array $events = []): array
    {
        return $this->request('POST', "/webhook/set/{$instanceName}", [
            'url' => $url,
            'webhook_by_events' => config('filament-evolution.webhook.by_events', false),
            'webhook_base64' => config('filament-evolution.webhook.base64', false),
            'events' => $events ?: config('filament-evolution.webhook.events', []),
        ]);
    }

    /**
     * Get webhook configuration for an instance.
     *
     * @throws EvolutionApiException
     */
    public function getWebhook(string $instanceName): array
    {
        return $this->request('GET', "/webhook/find/{$instanceName}");
    }

    /**
     * Find contacts.
     *
     * @throws EvolutionApiException
     */
    public function findContacts(string $instanceName, array $numbers): array
    {
        return $this->request('POST', "/chat/whatsappNumbers/{$instanceName}", [
            'numbers' => $numbers,
        ]);
    }

    /**
     * Check if numbers are registered on WhatsApp.
     *
     * @throws EvolutionApiException
     */
    public function checkNumbers(string $instanceName, array $numbers): array
    {
        return $this->request('POST', "/chat/whatsappNumbers/{$instanceName}", [
            'numbers' => $numbers,
        ]);
    }

    /**
     * Get profile picture URL.
     *
     * @throws EvolutionApiException
     */
    public function getProfilePicture(string $instanceName, string $number): array
    {
        return $this->request('POST', "/chat/fetchProfilePictureUrl/{$instanceName}", [
            'number' => $number,
        ]);
    }

    /**
     * Fetch all messages from a chat.
     *
     * @throws EvolutionApiException
     */
    public function fetchMessages(string $instanceName, string $remoteJid, int $limit = 20): array
    {
        return $this->request('POST', "/chat/findMessages/{$instanceName}", [
            'where' => [
                'key' => [
                    'remoteJid' => $remoteJid,
                ],
            ],
            'limit' => $limit,
        ]);
    }

    /**
     * Get the configured base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Check if the client is properly configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->baseUrl) && ! empty($this->apiKey);
    }
}
