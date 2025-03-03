<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'comment_id', 'reply_id', 'blog_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
