<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Exceptions\EvolutionApiException;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;

class WhatsappService
{
    protected EvolutionClient $client;

    public function __construct(EvolutionClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get a WhatsApp instance by ID.
     */
    public function getInstance(string|int $instanceId): ?WhatsappInstance
    {
        return WhatsappInstance::find($instanceId);
    }

    /**
     * Get all connected instances.
     */
    public function getConnectedInstances(): Collection
    {
        return WhatsappInstance::where('status', StatusConnectionEnum::OPEN)->get();
    }

    /**
     * Format a phone number for WhatsApp.
     */
    public function formatNumber(string $number): string
    {
        // Remove all non-digits
        $number = preg_replace('/\D/', '', $number);

        // If Brazilian number without country code, add it
        if (strlen($number) === 10 || strlen($number) === 11) {
            $number = '55'.$number;
        }

        return $number;
    }

    /**
     * Get media content for Evolution API.
     * Returns base64 encoded string (without data: prefix) for local files, or URL for remote files.
     */
    public function getMediaContent(string $path, ?string $disk = null): string
    {
        $disk = $disk ?? config('filament-evolution.media.disk', 'public');

        // If it's already a URL, return as-is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // For local files, convert to base64 (Evolution API expects raw base64 without data: prefix)
        $storage = Storage::disk($disk);

        if (! $storage->exists($path)) {
            throw new EvolutionApiException("File not found: {$path}");
        }

        $contents = $storage->get($path);

        return base64_encode($contents);
    }

    /**
     * Get public URL for a file (supports local and S3).
     *
     * @deprecated Use getMediaContent() instead for Evolution API
     */
    public function getFileUrl(string $path, ?string $disk = null): string
    {
        $disk = $disk ?? config('filesystems.default');

        // If it's already a URL, return as-is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Check if it's a temporary upload path
        if (str_starts_with($path, 'livewire-tmp/')) {
            return Storage::disk($disk)->temporaryUrl($path, now()->addMinutes(5));
        }

        // For S3/cloud storage, use temporary URL for private files
        $diskConfig = config("filesystems.disks.{$disk}");

        if (isset($diskConfig['driver']) && $diskConfig['driver'] === 's3') {
            return Storage::disk($disk)->temporaryUrl($path, now()->addMinutes(30));
        }

        // For local storage, return public URL
        return Storage::disk($disk)->url($path);
    }

    /**
     * Store an uploaded file and return its path.
     */
    public function storeFile(UploadedFile $file, string $directory = 'whatsapp-media', ?string $disk = null): string
    {
        $disk = $disk ?? config('filament-evolution.media.disk', 'public');

        return $file->store($directory, $disk);
    }

    /**
     * Send a text message.
     *
     * @throws EvolutionApiException
     */
    public function sendText(string|int $instanceId, string $number, string $message): array
    {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);

        return $this->client->sendText($instance->name, $number, $message);
    }

    /**
     * Send an image message.
     *
     * @throws EvolutionApiException
     */
    public function sendImage(
        string|int $instanceId,
        string $number,
        string $mediaPath,
        ?string $caption = null,
        ?string $disk = null
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);
        $media = $this->getMediaContent($mediaPath, $disk);

        return $this->client->sendImage($instance->name, $number, $media, $caption);
    }

    /**
     * Send a video message.
     *
     * @throws EvolutionApiException
     */
    public function sendVideo(
        string|int $instanceId,
        string $number,
        string $mediaPath,
        ?string $caption = null,
        ?string $disk = null
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);
        $media = $this->getMediaContent($mediaPath, $disk);

        return $this->client->sendVideo($instance->name, $number, $media, $caption);
    }

    /**
     * Send an audio message.
     *
     * @throws EvolutionApiException
     */
    public function sendAudio(
        string|int $instanceId,
        string $number,
        string $mediaPath,
        ?string $disk = null
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);
        $media = $this->getMediaContent($mediaPath, $disk);

        return $this->client->sendAudio($instance->name, $number, $media);
    }

    /**
     * Send a document.
     *
     * @throws EvolutionApiException
     */
    public function sendDocument(
        string|int $instanceId,
        string $number,
        string $mediaPath,
        ?string $fileName = null,
        ?string $caption = null,
        ?string $disk = null
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);
        $media = $this->getMediaContent($mediaPath, $disk);

        // Extract filename from path if not provided
        $fileName = $fileName ?? basename($mediaPath);

        return $this->client->sendDocument($instance->name, $number, $media, $fileName, $caption);
    }

    /**
     * Send a location.
     *
     * @throws EvolutionApiException
     */
    public function sendLocation(
        string|int $instanceId,
        string $number,
        float $latitude,
        float $longitude,
        ?string $name = null,
        ?string $address = null
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);

        return $this->client->sendLocation($instance->name, $number, $latitude, $longitude, $name, $address);
    }

    /**
     * Send a contact card.
     *
     * @throws EvolutionApiException
     */
    public function sendContact(
        string|int $instanceId,
        string $number,
        string $contactName,
        string $contactNumber
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);
        $contactNumber = $this->formatNumber($contactNumber);

        return $this->client->sendContact($instance->name, $number, $contactName, $contactNumber);
    }

    /**
     * Send an interactive button message (reply / mixed).
     *
     * See EvolutionClient::sendButtons() for button shape constraints.
     *
     * @throws EvolutionApiException
     */
    public function sendButtons(
        string|int $instanceId,
        string $number,
        string $description,
        array $buttons,
        ?string $title = null,
        ?string $footer = null,
        array $options = []
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);

        return $this->client->sendButtons(
            $instance->name,
            $number,
            $description,
            $buttons,
            $title,
            $footer,
            $options
        );
    }

    /**
     * Send up to 2 CTA buttons (url / call / copy). Cannot be mixed with reply or PIX buttons.
     *
     * @throws EvolutionApiException
     */
    public function sendCta(
        string|int $instanceId,
        string $number,
        string $description,
        array $buttons,
        ?string $title = null,
        ?string $footer = null,
        array $options = []
    ): array {
        return $this->sendButtons($instanceId, $number, $description, $buttons, $title, $footer, $options);
    }

    /**
     * Send a single PIX (payment_info) button. Must be isolated — exactly 1 button, no mixing.
     *
     * @throws EvolutionApiException
     */
    public function sendPix(
        string|int $instanceId,
        string $number,
        string $description,
        array $pix,
        ?string $title = null,
        ?string $footer = null,
        array $options = []
    ): array {
        $button = array_merge(['type' => 'pix'], $pix);

        return $this->sendButtons($instanceId, $number, $description, [$button], $title, $footer, $options);
    }

    /**
     * Send a list message (legacy listMessage / SINGLE_SELECT).
     *
     * @throws EvolutionApiException
     */
    public function sendList(
        string|int $instanceId,
        string $number,
        string $title,
        string $description,
        string $buttonText,
        array $sections,
        ?string $footerText = null,
        array $options = []
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);

        return $this->client->sendList(
            $instance->name,
            $number,
            $title,
            $description,
            $buttonText,
            $sections,
            $footerText,
            $options
        );
    }

    /**
     * Send a product carousel (multi-card).
     *
     * @throws EvolutionApiException
     */
    public function sendCarousel(
        string|int $instanceId,
        string $number,
        string $message,
        array $cards,
        array $options = []
    ): array {
        $instance = $this->resolveInstance($instanceId);
        $number = $this->formatNumber($number);

        return $this->client->sendCarousel($instance->name, $number, $message, $cards, $options);
    }

    /**
     * Generic send method that routes to the appropriate type.
     *
     * @param  string|array  $content  The message content (text string, file path, or array for
     *                                 location/contact/buttons/list/carousel/pix)
     *
     * @throws EvolutionApiException
     */
    public function send(
        string|int $instanceId,
        string $number,
        string|MessageTypeEnum $type,
        string|array $content,
        array $options = []
    ): array {
        $type = $type instanceof MessageTypeEnum ? $type : MessageTypeEnum::from($type);

        return match ($type) {
            MessageTypeEnum::TEXT => $this->sendText($instanceId, $number, $content),
            MessageTypeEnum::IMAGE => $this->sendImage(
                $instanceId,
                $number,
                $content,
                $options['caption'] ?? null,
                $options['disk'] ?? null
            ),
            MessageTypeEnum::VIDEO => $this->sendVideo(
                $instanceId,
                $number,
                $content,
                $options['caption'] ?? null,
                $options['disk'] ?? null
            ),
            MessageTypeEnum::AUDIO => $this->sendAudio(
                $instanceId,
                $number,
                $content,
                $options['disk'] ?? null
            ),
            MessageTypeEnum::DOCUMENT => $this->sendDocument(
                $instanceId,
                $number,
                $content,
                $options['fileName'] ?? null,
                $options['caption'] ?? null,
                $options['disk'] ?? null
            ),
            MessageTypeEnum::LOCATION => $this->sendLocation(
                $instanceId,
                $number,
                $content['latitude'],
                $content['longitude'],
                $content['name'] ?? null,
                $content['address'] ?? null
            ),
            MessageTypeEnum::CONTACT => $this->sendContact(
                $instanceId,
                $number,
                $content['name'],
                $content['number']
            ),
            MessageTypeEnum::BUTTONS, MessageTypeEnum::CTA => $this->sendButtons(
                $instanceId,
                $number,
                $content['description'] ?? '',
                $content['buttons'] ?? [],
                $content['title'] ?? null,
                $content['footer'] ?? null,
                $options
            ),
            MessageTypeEnum::PIX => $this->sendPix(
                $instanceId,
                $number,
                $content['description'] ?? '',
                $content['pix'] ?? $content,
                $content['title'] ?? null,
                $content['footer'] ?? null,
                $options
            ),
            MessageTypeEnum::LIST => $this->sendList(
                $instanceId,
                $number,
                $content['title'] ?? '',
                $content['description'] ?? '',
                $content['buttonText'] ?? '',
                $content['sections'] ?? [],
                $content['footerText'] ?? null,
                $options
            ),
            MessageTypeEnum::CAROUSEL => $this->sendCarousel(
                $instanceId,
                $number,
                $content['message'] ?? '',
                $content['cards'] ?? [],
                $options
            ),
            default => throw new EvolutionApiException("Unsupported message type: {$type->value}"),
        };
    }

    /**
     * Resolve instance from ID or model.
     *
     * @throws EvolutionApiException
     */
    protected function resolveInstance(string|int $instanceId): WhatsappInstance
    {
        $instance = $instanceId instanceof WhatsappInstance
            ? $instanceId
            : $this->getInstance($instanceId);

        if (! $instance) {
            throw new EvolutionApiException("WhatsApp instance not found: {$instanceId}");
        }

        if (! $instance->isConnected()) {
            throw new EvolutionApiException("WhatsApp instance is not connected: {$instance->name}");
        }

        return $instance;
    }
}
