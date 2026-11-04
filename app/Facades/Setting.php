<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\Settings\SettingsManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed get(string $key, mixed $default = null, ?int $businessId = null, ?int $branchId = null)
 * @method static \App\Modules\Core\Models\Setting set(string $key, mixed $value, string $group = 'general', ?int $businessId = null, ?int $branchId = null, bool $isPublic = false)
 * @method static array all(?int $businessId = null, ?int $branchId = null)
 *
 * @see \App\Services\Settings\SettingsManager
 */
class Setting extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SettingsManager::class;
    }
}
