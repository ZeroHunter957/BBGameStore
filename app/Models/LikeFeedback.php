<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeFeedback extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'feedback_id', 'reply_feedback_id', 'game_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function replyFeedback()
    {
        return $this->belongsTo(ReplyFeedback::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
