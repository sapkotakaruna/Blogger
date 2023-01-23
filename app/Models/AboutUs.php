<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'slug',
        'profile',
        'email',
        'phone',
        'photo',
        'skill',
        'description',
        'rank',
        'status'
    ];
}
