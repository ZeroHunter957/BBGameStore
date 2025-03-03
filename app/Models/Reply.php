<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'comment_id', 'like_count', 'account_id', 'created_at', 'updated_at'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
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
