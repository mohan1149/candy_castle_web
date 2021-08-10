<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner',
        'status',
        'order_cost',
        'customer_id',
        'payment_method',
        'delivery_address',
        'trasaction_number',
    ];
}
