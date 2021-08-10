<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner',
        'name',
        'phone',
        'email',
        'email',
        'profile_picture',
        'city',
        'area',
        'block',
        'street',
        'house_number',
        'password',
        'fcm',
    ];
}
