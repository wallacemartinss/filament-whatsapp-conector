<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Concerns;

use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;
use WallaceMartinss\FilamentEvolution\Exceptions\EvolutionApiException;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;
use WallaceMartinss\FilamentEvolution\Services\WhatsappService;

/**
 * Trait to easily send WhatsApp messages from any class.
 *
 * Usage:
 * ```php
 * class InvoiceService
 * {
 *     use CanSendWhatsappMessage;
 *
 *     public function sendInvoiceNotification(Invoice $invoice): void
 *     {
 *         $this->sendWhatsappText(
 *             $invoice->customer->phone,
 *             "Olá {$invoice->customer->name}, sua fatura #{$invoice->number} vence em {$invoice->due_date->format('d/m/Y')}."
 *         );
 *     }
 * }
 * ```
 */
trait CanSendWhatsappMessage
{
    /**
     * Get the WhatsApp instance ID to use for sending messages.
     * Override this method to customize instance selection.
     */
    protected function getWhatsappInstanceId(): ?string
    {
        // Try to get from config default instance
        $defaultInstance = config('filament-evolution.default_instance');

        if ($defaultInstance) {
            return $defaultInstance;
        }

        // Get the first connected instance
        $instance = $this->whatsappService()->getConnectedInstances()->first();

        return $instance?->id;
    }

    /**
     * Get the WhatsApp service instance.
     */
    protected function whatsappService(): WhatsappService
    {
        return app(WhatsappService::class);
    }

    /**
     * Send a text message via WhatsApp.
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappText(string $number, string $message, ?string $instanceId = null): array
    {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->sendText($instanceId, $number, $message);
    }

    /**
     * Send an image via WhatsApp.
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappImage(
        string $number,
        string $imagePath,
        ?string $caption = null,
        ?string $instanceId = null,
        ?string $disk = null
    ): array {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->sendImage($instanceId, $number, $imagePath, $caption, $disk);
    }

    /**
     * Send a video via WhatsApp.
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappVideo(
        string $number,
        string $videoPath,
        ?string $caption = null,
        ?string $instanceId = null,
        ?string $disk = null
    ): array {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->sendVideo($instanceId, $number, $videoPath, $caption, $disk);
    }

    /**
     * Send an audio via WhatsApp.
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappAudio(
        string $number,
        string $audioPath,
        ?string $instanceId = null,
        ?string $disk = null
    ): array {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->sendAudio($instanceId, $number, $audioPath, $disk);
    }

    /**
     * Send a document via WhatsApp.
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappDocument(
        string $number,
        string $documentPath,
        ?string $fileName = null,
        ?string $caption = null,
        ?string $instanceId = null,
        ?string $disk = null
    ): array {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->sendDocument($instanceId, $number, $documentPath, $fileName, $caption, $disk);
    }

    /**
     * Send a location via WhatsApp.
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappLocation(
        string $number,
        float $latitude,
        float $longitude,
        ?string $name = null,
        ?string $address = null,
        ?string $instanceId = null
    ): array {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->sendLocation($instanceId, $number, $latitude, $longitude, $name, $address);
    }

    /**
     * Send a contact card via WhatsApp.
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappContact(
        string $number,
        string $contactName,
        string $contactNumber,
        ?string $instanceId = null
    ): array {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->sendContact($instanceId, $number, $contactName, $contactNumber);
    }

    /**
     * Generic method to send any type of WhatsApp message.
     *
     * @param  string|array  $content  Message content
     *
     * @throws EvolutionApiException
     */
    protected function sendWhatsappMessage(
        string $number,
        string|MessageTypeEnum $type,
        string|array $content,
        array $options = [],
        ?string $instanceId = null
    ): array {
        $instanceId = $instanceId ?? $this->getWhatsappInstanceId();

        if (! $instanceId) {
            throw new EvolutionApiException('No WhatsApp instance available for sending messages.');
        }

        return $this->whatsappService()->send($instanceId, $number, $type, $content, $options);
    }

    /**
     * Check if there's a connected WhatsApp instance available.
     */
    protected function hasWhatsappInstance(): bool
    {
        return $this->getWhatsappInstanceId() !== null;
    }

    /**
     * Get all connected WhatsApp instances.
     *
     * @return \Illuminate\Database\Eloquent\Collection<WhatsappInstance>
     */
    protected function getConnectedWhatsappInstances(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->whatsappService()->getConnectedInstances();
    }
}
