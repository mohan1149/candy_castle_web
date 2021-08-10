<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $casts = [
        'expert_in' => 'array'
    ];
    protected $fillable = [
        'owner',
        'salon_id',
        'name',
        'phone',
        'civil_id',
        'email',
        'profile_picture',
        'expert_in',
        'role',
        'rating',
        'address',
        'password',
        'fcm'
    ];
}
