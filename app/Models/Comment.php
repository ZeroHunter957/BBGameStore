<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'account_id', 'like_count', 'blog_id', 'created_at', 'updated_at'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getLikeCountAttribute()
    {
        return $this->likes()->count();
    }
}
