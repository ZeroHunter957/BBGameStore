<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total_price'];

    // Liên kết với User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Liên kết với OrderItem
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
