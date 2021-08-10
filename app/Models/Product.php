<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner',
        'name',
        'sku',
        'description',
        'weight',
        'type',
        'category_id',
        'purchase_price',
        'selling_price',
        'stock_quantity',
        'image',
    ];
}
