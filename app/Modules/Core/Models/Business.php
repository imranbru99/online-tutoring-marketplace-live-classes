<?php

declare(strict_types=1);

namespace App\Modules\Core\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use ImranDev\UniversalSlug\SlugOptions;
use ImranDev\UniversalSlug\Traits\HasUniversalSlug;

class Business extends Model
{
    use HasFactory, HasUniversalSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'domain',
        'subdomain',
        'email',
        'phone',
        'logo_url',
        'favicon_url',
        'primary_color',
        'default_language',
        'default_currency',
        'default_timezone',
        'mode',
        'status',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function mainBranch(): ?Branch
    {
        return $this->branches()->where('is_main', true)->first();
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function moduleStates(): HasMany
    {
        return $this->hasMany(ModuleState::class);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }
}
