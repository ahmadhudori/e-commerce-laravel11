<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
	'amount',
	'product_id',
	'order_id'
    ];

    public function order():HasOne
    {
	return $this->hasOne(Order::class);
    }

    public function product():HasOne
    {
	return $this->hasOne(Product::class);
    }
}
