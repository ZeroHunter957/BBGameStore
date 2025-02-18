<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $fillable = ['cat_id', 'name', 'price', 'description', 'image'];

    public function category()
    {
        return $this->belongsTo(AccessoryCategory::class, "cat_id");
    }
}