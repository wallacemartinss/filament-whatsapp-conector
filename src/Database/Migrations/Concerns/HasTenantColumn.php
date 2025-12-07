<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Database\Migrations\Concerns;

use Illuminate\Database\Schema\Blueprint;

trait HasTenantColumn
{
    /**
     * Add tenant column to the table based on config.
     */
    protected function addTenantColumn(Blueprint $table): void
    {
        if (! config('filament-evolution.tenancy.enabled', false)) {
            return;
        }

        $column = config('filament-evolution.tenancy.column', 'team_id');
        $tenantTable = config('filament-evolution.tenancy.table', 'teams');
        $columnType = config('filament-evolution.tenancy.column_type', 'uuid');

        if ($columnType === 'uuid') {
            $table->foreignUuid($column)
                ->constrained($tenantTable)
                ->cascadeOnDelete();
        } else {
            $table->foreignId($column)
                ->constrained($tenantTable)
                ->cascadeOnDelete();
        }

        $table->index($column);
    }

    /**
     * Check if tenancy is enabled.
     */
    protected function hasTenancy(): bool
    {
        return config('filament-evolution.tenancy.enabled', false);
    }

    /**
     * Get the tenant column name.
     */
    protected function getTenantColumn(): ?string
    {
        if (! $this->hasTenancy()) {
            return null;
        }

        return config('filament-evolution.tenancy.column', 'team_id');
    }
}
