<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'account_id', 'like_count',  'star', 'game_id', 'created_at', 'updated_at'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }


    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function replyFeedbacks()
    {
        return $this->hasMany(ReplyFeedback::class);
    }

    public function likeFeedbacks()
    {
        return $this->hasMany(LikeFeedback::class);
    }

    public function getLikeCountAttribute()
    {
        return $this->likeFeedbacks()->count();
    }

    
}
