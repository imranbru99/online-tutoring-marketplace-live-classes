<?php

declare(strict_types=1);

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class SystemHealthLog extends Model
{
    protected $table = 'system_health_logs';

    protected $fillable = [
        'check_type',
        'status',
        'metrics',
        'message',
    ];

    protected $casts = [
        'metrics' => 'array',
    ];
}
