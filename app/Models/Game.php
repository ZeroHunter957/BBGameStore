<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;

class Game extends Model
{
    protected $fillable = ['cat_id', 'title', 'price', 'description', 'developer', 'platform', 'release_date', 'image', 'file'];

    public function category()
    {
        return $this->belongsTo(GameCategory::class, "cat_id");
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}