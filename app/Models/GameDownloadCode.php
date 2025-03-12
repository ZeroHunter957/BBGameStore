<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameDownloadCode extends Model
{
    protected $fillable = ['account_id', 'game_id', 'download_code', 'last_download_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
