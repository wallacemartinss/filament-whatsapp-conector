<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Console\Commands;

use Illuminate\Console\Command;
use WallaceMartinss\FilamentEvolution\Models\WhatsappMessage;
use WallaceMartinss\FilamentEvolution\Models\WhatsappWebhook;

class CleanupCommand extends Command
{
    protected $signature = 'evolution:cleanup
                            {--webhooks-days= : Override webhook cleanup days from config}
                            {--messages-days= : Override messages cleanup days from config}
                            {--dry-run : Show what would be deleted without actually deleting}';

    protected $description = 'Cleanup old webhook logs and messages';

    public function handle(): int
    {
        $webhooksDays = $this->option('webhooks-days') ?? config('filament-evolution.cleanup.webhooks_days');
        $messagesDays = $this->option('messages-days') ?? config('filament-evolution.cleanup.messages_days');
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->info('🔍 Dry run mode - no records will be deleted');
            $this->newLine();
        }

        $totalDeleted = 0;

        // Cleanup webhooks
        if ($webhooksDays !== null) {
            $webhooksDays = (int) $webhooksDays;
            $cutoffDate = now()->subDays($webhooksDays);

            $count = WhatsappWebhook::where('created_at', '<', $cutoffDate)->count();

            if ($dryRun) {
                $this->info("📋 Would delete {$count} webhooks older than {$webhooksDays} days");
            } else {
                $deleted = WhatsappWebhook::where('created_at', '<', $cutoffDate)->delete();
                $this->info("🗑️  Deleted {$deleted} webhooks older than {$webhooksDays} days");
                $totalDeleted += $deleted;
            }
        } else {
            $this->info('⏭️  Webhook cleanup disabled (webhooks_days is null)');
        }

        // Cleanup messages
        if ($messagesDays !== null) {
            $messagesDays = (int) $messagesDays;
            $cutoffDate = now()->subDays($messagesDays);

            $count = WhatsappMessage::where('created_at', '<', $cutoffDate)->count();

            if ($dryRun) {
                $this->info("📋 Would delete {$count} messages older than {$messagesDays} days");
            } else {
                $deleted = WhatsappMessage::where('created_at', '<', $cutoffDate)->delete();
                $this->info("🗑️  Deleted {$deleted} messages older than {$messagesDays} days");
                $totalDeleted += $deleted;
            }
        } else {
            $this->info('⏭️  Message cleanup disabled (messages_days is null)');
        }

        $this->newLine();

        if ($dryRun) {
            $this->info('✅ Dry run complete. Run without --dry-run to delete records.');
        } else {
            $this->info("✅ Cleanup complete. Total records deleted: {$totalDeleted}");
        }

        return self::SUCCESS;
    }
}
