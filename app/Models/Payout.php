<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payout extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'reference_number',
        'merchant_id',
        'amount',
        'status',
        'provider_reference',
    ];

    protected $casts = [
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
                $model->reference_number = 'PAY-' . strtoupper(Str::random(12));
            }
        });
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }
}
