<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
	'amount',
	'product_id',
	'order_id'
    ];

    public function order():BelongsTo
    {
	return $this->belongsTo(Order::class);
    }

    public function product():BelongsTo
    {
	return $this->belongsTo(Product::class);
    }
}
