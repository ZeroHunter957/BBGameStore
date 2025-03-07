<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'product_type',
        'quantity',
        'price'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, "order_id");
    }

    public function game()
    {
        return $this->belongsTo(Game::class, "product_id");
    }

     // Liên kết với Order
     public function order() {
        return $this->belongsTo(Order::class);
    }
}
