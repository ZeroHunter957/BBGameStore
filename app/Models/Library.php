<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $fillable = ['accounts_id', 'games_id'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'accounts_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'games_id');
    }
}
