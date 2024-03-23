<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = [
        'theme',
        'username',
        'category_id',
        'date',
        'number',
        'shifr',
        'status',
        'file',
    ];
    public function calclus(){
        return $this->hasMany(Vote::class,'vote_id');
    }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
