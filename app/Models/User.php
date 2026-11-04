<?php

declare(strict_types=1);

namespace App\Models;

use App\Modules\Core\Models\Branch;
use App\Modules\Core\Models\Business;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    protected $fillable = [
        'business_id',
        'current_branch_id',
        'name',
        'email',
        'password',
        'phone',
        'avatar_url',
        'timezone',
        'locale',
        'status',
        'bio',
        'metadata',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'metadata' => 'array',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function currentBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'current_branch_id');
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'user_branches')
            ->withPivot('is_primary', 'role')
            ->withTimestamps();
    }

    public function getFilamentName(): string
    {
        return $this->name ?? 'User';
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        // Super Admin has universal access
        if ($this->hasRole('super_admin')) {
            return true;
        }

        return match ($panel->getId()) {
            'super-admin' => false,
            'admin' => $this->hasRole('business_admin'),
            'branch' => $this->hasAnyRole(['business_admin', 'branch_manager']),
            'tutor' => $this->hasRole('tutor'),
            'student' => $this->hasRole('student'),
            'guardian' => $this->hasRole('guardian'),
            'support' => $this->hasAnyRole(['business_admin', 'support_agent', 'moderator']),
            'finance' => $this->hasAnyRole(['business_admin', 'finance_manager']),
            'content' => $this->hasAnyRole(['business_admin', 'content_manager', 'academic_coordinator']),
            'institution' => $this->hasAnyRole(['business_admin', 'institution_admin']),
            'affiliate' => $this->hasRole('affiliate_partner'),
            default => true,
        };
    }
}
