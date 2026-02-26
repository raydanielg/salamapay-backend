<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'reference_number',
        'type',
        'from_user_id',
        'to_user_id',
        'amount',
        'currency',
        'provider_reference',
        'status',
        'risk_score',
        'ip_address',
        'device_hash',
        'metadata',
        'signature',
    ];

    protected $casts = [
        'metadata' => 'json',
        'amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
            if (empty($model->reference_number)) {
                $model->reference_number = 'TRX-' . strtoupper(Str::random(12));
            }
            // Generate signature for security
            $model->signature = hash_hmac('sha256', 
                $model->reference_number . $model->amount . ($model->from_user_id ?? 'system'), 
                config('app.key')
            );
        });
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
