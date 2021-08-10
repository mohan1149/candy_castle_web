<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $casts = [
        'salon_id' => 'array'
    ];
    protected $fillable = [
        'owner',
        'salon_id',
        'service_category_id',
        'name',
        'charge',
        'thumbnail',
        'duration',
        'description',
    ];
}
