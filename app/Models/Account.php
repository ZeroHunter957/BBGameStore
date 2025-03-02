<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    protected $fillable = ["email", "fullname", "password", "otp", "expireotp", "status", "isverify", "role", "profile_image"];

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'user_id'); // Ensure correct foreign key
    }
}