<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'account_id', 'order_code', 'total_amount', 'payment_method', 'transaction_id', 'status', 'created_at', 'updated_at'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

