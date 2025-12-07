<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTenant
{
    public static function bootHasTenant(): void
    {
        if (! config('filament-evolution.tenancy.enabled', false)) {
            return;
        }

        // Global scope to filter by tenant
        static::addGlobalScope('tenant', function (Builder $query) {
            $tenantColumn = config('filament-evolution.tenancy.column', 'team_id');

            if (function_exists('filament') && filament()->getTenant()) {
                $query->where($tenantColumn, filament()->getTenant()->getKey());
            }
        });

        // Auto-fill tenant on create
        static::creating(function ($model) {
            $tenantColumn = config('filament-evolution.tenancy.column', 'team_id');

            if (function_exists('filament') && filament()->getTenant() && empty($model->{$tenantColumn})) {
                $model->{$tenantColumn} = filament()->getTenant()->getKey();
            }
        });
    }

    /**
     * Dynamic relationship with the Tenant model.
     */
    public function tenant(): ?BelongsTo
    {
        if (! config('filament-evolution.tenancy.enabled', false)) {
            return null;
        }

        $tenantColumn = config('filament-evolution.tenancy.column', 'team_id');
        $tenantModel = config('filament-evolution.tenancy.model', 'App\\Models\\Team');

        return $this->belongsTo($tenantModel, $tenantColumn);
    }

    /**
     * Get the tenant column name.
     */
    public function getTenantColumn(): ?string
    {
        if (! config('filament-evolution.tenancy.enabled', false)) {
            return null;
        }

        return config('filament-evolution.tenancy.column', 'team_id');
    }

    /**
     * Check if tenancy is enabled.
     */
    public static function hasTenancy(): bool
    {
        return config('filament-evolution.tenancy.enabled', false);
    }

    /**
     * Scope to filter by specific tenant.
     */
    public function scopeForTenant(Builder $query, $tenantId): Builder
    {
        if (! config('filament-evolution.tenancy.enabled', false)) {
            return $query;
        }

        $tenantColumn = config('filament-evolution.tenancy.column', 'team_id');

        return $query->where($tenantColumn, $tenantId);
    }

    /**
     * Scope to bypass tenant filter.
     */
    public function scopeWithoutTenantScope(Builder $query): Builder
    {
        return $query->withoutGlobalScope('tenant');
    }
}
