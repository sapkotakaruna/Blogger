<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'sub_title',
        'author',
        'photo',
        'description',
        'rank',
        'status'
    ];
}
