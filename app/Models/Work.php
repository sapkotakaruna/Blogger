<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $table='works';
    protected $fillable=[
        'title',
        'slug',
        'sub_title',
        'photo',
        'rank',
        'status'
    ];
}
