<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use WallaceMartinss\FilamentEvolution\Data\MessageData;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;

class MessageReceived
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public WhatsappInstance $instance,
        public MessageData $message,
    ) {}
}
