<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotesMembers extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'vote_id',
        'user_id',
        'status',
    ];
}
