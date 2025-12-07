<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Facades;

use Illuminate\Support\Facades\Facade;
use WallaceMartinss\FilamentEvolution\Services\WhatsappService;

/**
 * @method static array sendText(string|int $instanceId, string $number, string $message)
 * @method static array sendImage(string|int $instanceId, string $number, string $mediaPath, ?string $caption = null)
 * @method static array sendVideo(string|int $instanceId, string $number, string $mediaPath, ?string $caption = null)
 * @method static array sendAudio(string|int $instanceId, string $number, string $mediaPath)
 * @method static array sendDocument(string|int $instanceId, string $number, string $mediaPath, ?string $fileName = null, ?string $caption = null)
 * @method static array sendLocation(string|int $instanceId, string $number, float $latitude, float $longitude, ?string $name = null, ?string $address = null)
 * @method static array sendContact(string|int $instanceId, string $number, string $contactName, string $contactNumber)
 * @method static array send(string|int $instanceId, string $number, string $type, string|array $content, array $options = [])
 * @method static \WallaceMartinss\FilamentEvolution\Models\WhatsappInstance|null getInstance(string|int $instanceId)
 * @method static \Illuminate\Database\Eloquent\Collection getConnectedInstances()
 *
 * @see \WallaceMartinss\FilamentEvolution\Services\WhatsappService
 */
class Whatsapp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WhatsappService::class;
    }
}
