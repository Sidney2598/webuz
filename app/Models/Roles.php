<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'guard_name',
        
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'model_has_roles','role_id', 'model_id');
    }   
}
