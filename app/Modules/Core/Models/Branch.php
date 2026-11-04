<?php

declare(strict_types=1);

namespace App\Modules\Core\Models;

use App\Models\Concerns\BelongsToTenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use ImranDev\UniversalSlug\SlugOptions;
use ImranDev\UniversalSlug\Traits\HasUniversalSlug;

class Branch extends Model
{
    use BelongsToTenant, HasFactory, HasUniversalSlug, SoftDeletes;

    protected $fillable = [
        'business_id',
        'name',
        'code',
        'slug',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'timezone',
        'is_main',
        'status',
        'module_overrides',
        'settings',
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'module_overrides' => 'array',
        'settings' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_branches')
            ->withPivot('is_primary', 'role')
            ->withTimestamps();
    }
}
