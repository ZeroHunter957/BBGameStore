<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'wishable_id', 'wishable_type'];

    public function wishable()
    {
        return $this->morphTo();
    }
}