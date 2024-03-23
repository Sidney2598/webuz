<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;

class Calclus extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'degre_id',
    ];
    

}
