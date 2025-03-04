<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'status',
        'created_at',
        'updated_at',
    ];

    // Mối quan hệ với User
    public function user()
    {
        return $this->belongsTo(Account::class, 'user_id', 'id');
    }

    // Mối quan hệ với Product (nhiều-nhiều)
    public function games()
    {
        return $this->belongsToMany(Game::class, 'order_game')
                    ->withPivot('quantity') // Lấy thêm trường `quantity` từ bảng trung gian
                    ->withTimestamps(); // Lấy thêm `created_at` và `updated_at`
    }
}
