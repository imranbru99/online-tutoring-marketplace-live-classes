<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\Module\ModuleManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection all()
 * @method static array|null get(string $key)
 * @method static bool has(string $key)
 * @method static bool isEnabled(string $key, ?int $businessId = null, ?int $branchId = null)
 * @method static bool enabled(string $key, ?int $businessId = null, ?int $branchId = null)
 * @method static array enable(string $key, ?int $businessId = null, ?int $branchId = null)
 * @method static array disable(string $key, ?int $businessId = null, ?int $branchId = null)
 * @method static array getAvailablePresets()
 * @method static array applyPreset(string $presetKey, int $businessId, ?int $branchId = null)
 *
 * @see \App\Services\Module\ModuleManager
 */
class Module extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ModuleManager::class;
    }

    /**
     * Shorthand helper: Module::enabled('key')
     */
    public static function enabled(string $key, ?int $businessId = null, ?int $branchId = null): bool
    {
        return static::getFacadeRoot()->isEnabled($key, $businessId, $branchId);
    }
}
