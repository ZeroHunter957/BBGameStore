<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyFeedback extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'feedback_id', 'account_id', 'created_at', 'updated_at'];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
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
