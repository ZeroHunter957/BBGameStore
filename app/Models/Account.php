<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Account extends Authenticatable
{
    use Notifiable;
    protected $fillable = ["email", "fullname", "password", "otp", "expireotp", "status", "isverify", "role", "profile_image"];
}
