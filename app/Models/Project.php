<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'client_id',
        'provider_id',
        'budget',
        'escrow_amount',
        'category',
        'attachments',
        'status',
        'deadline',
        'started_at',
        'completed_at',
        'milestones',
        'client_requirements',
        'provider_notes',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'escrow_amount' => 'decimal:2',
        'attachments' => 'array',
        'milestones' => 'array',
        'deadline' => 'date',
        'started_at' => 'date',
        'completed_at' => 'date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
