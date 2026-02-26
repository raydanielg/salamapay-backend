<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Withdrawal extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'reference_number',
        'user_id',
        'amount',
        'provider_reference',
        'status',
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
                $model->reference_number = 'WDL-' . strtoupper(Str::random(12));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
