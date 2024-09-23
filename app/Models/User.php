<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Referral_Reward;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referrer_id',
        'balance',
        'referral_link',
        'user_level',
        'state',
        'cfm',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }
 
    // Each user can have many referrals (users they have referred)
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id');
    }
 
    // Each user can have many referral rewards (reward records for this user)
    public function referralRewards()
    {
        return $this->hasMany(Referral_Reward::class);
    }
 
    // Each user can have many referral rewards they triggered for others (as a referrer)
    public function triggeredReferralRewards()
    {
        return $this->hasMany(Referral_Reward::class, 'referrer_id');
    }
    
}
