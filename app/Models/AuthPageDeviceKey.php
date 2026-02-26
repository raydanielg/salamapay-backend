<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuthPageDeviceKey extends Model
{
    protected $table = 'auth_page_device_keys';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'token_hash',
        'ip_address',
        'user_agent',
        'last_used_at',
        'expires_at',
        'revoked',
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
        'revoked' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
