<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use WallaceMartinss\FilamentEvolution\Http\Controllers\WebhookController;

// Webhook route - responds to Evolution API callbacks
Route::post('/api/webhooks/evolution', WebhookController::class)
    ->name('filament-evolution.webhook')
    ->withoutMiddleware(['auth', 'web']);
