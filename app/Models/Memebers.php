<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memebers extends Model
{
    protected $fillable = [
        'username',
        'category_id',
        'degree',
        'login',
        'password',
        'id'
    ];
}
