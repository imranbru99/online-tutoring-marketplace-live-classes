<?php

declare(strict_types=1);

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'business_id',
        'branch_id',
        'group',
        'key',
        'value',
        'type',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function getTypedValueAttribute(): mixed
    {
        if ($this->value === null) {
            return null;
        }

        return match ($this->type) {
            'boolean', 'bool' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'integer', 'int' => (int) $this->value,
            'float' => (float) $this->value,
            'json', 'array' => json_decode($this->value, true),
            default => $this->value,
        };
    }

    public static function setTypedValue(mixed $value, ?string &$type = null): ?string
    {
        if ($value === null) {
            $type = 'string';
            return null;
        }

        if (is_bool($value)) {
            $type = 'boolean';
            return $value ? '1' : '0';
        }

        if (is_int($value)) {
            $type = 'integer';
            return (string) $value;
        }

        if (is_float($value)) {
            $type = 'float';
            return (string) $value;
        }

        if (is_array($value) || is_object($value)) {
            $type = 'json';
            return json_encode($value);
        }

        $type = 'string';
        return (string) $value;
    }
}
