<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Referral_Reward extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'referrer_id',
        'amount',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    // Each reward belongs to a referrer (who triggered the reward)
    public function referrers()
    {
        return $this->belongsToMany(User::class);
    }
}
