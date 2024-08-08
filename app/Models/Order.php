<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
	'user_id',
	'is_paid',
	'payment_receipt',
    ];

    public function user():BelongsTo
    {
	return $this->belongsTo(User::class);
    }

    public function transactions():BelongsTo
    {
	return $this->belongsTo(Transaction::class);
    }
}
