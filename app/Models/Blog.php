<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'created_at', 'account_id', 'status'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

