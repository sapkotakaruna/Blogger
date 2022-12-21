<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trial extends Model
{
    use HasFactory;
    protected $fillable=[
      'name',
      'slug',
      'sub_title',
      'photo',
      'description',
      'status',
      'rank'
    ];
}
