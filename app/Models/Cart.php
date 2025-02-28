<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['account_id', 'product_id', 'product_type', 'name', 'quantity', 'price'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
