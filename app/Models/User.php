<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use HasinHayder\Tyro\Concerns\HasTyroRoles;
use HasinHayder\TyroLogin\Traits\HasTwoFactorAuth;



use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasTyroRoles, HasTwoFactorAuth;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->keyType = 'string';
            
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
            if (empty($model->account_number)) {
                $model->account_number = 'SP-' . strtoupper(Str::random(10));
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'account_number',
        'full_name',
        'email',
        'phone',
        'password',
        'kyc_status',
        'account_status',
        'two_factor_secret',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function providerProfile()
    {
        return $this->hasOne(ProviderProfile::class);
    }

    public function clientProjects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function providerProjects()
    {
        return $this->hasMany(Project::class, 'provider_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function escrowsAsBuyer()
    {
        return $this->hasMany(Escrow::class, 'buyer_id');
    }

    public function escrowsAsSeller()
    {
        return $this->hasMany(Escrow::class, 'seller_id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class, 'merchant_id');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    public function fraudFlags()
    {
        return $this->hasMany(FraudFlag::class);
    }
}
