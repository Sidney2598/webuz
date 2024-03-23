<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;
use App\Models\Permissions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard_name = 'web';
    protected $fillable = [
        'name',
        'degre_id',
        'category_id',
        'login',
        'email',
        'admin',
        'password',
        'ilmiy_daraja',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin():bool
    {
        return $this->admin;
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Roles::class,'model_has_roles','model_id','role_id');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class,'model_has_permissions','model_id','permission_id');
    }

    public function degre(){
        switch ($this->degre_id)
        {
            case 1:
                return "A'zo";
                break;
            case 2:
                return "Kotib";
                break;
            case 3:
                return "Rais kotibi";
                break;
            case 4:
                return "Rais";
                break;
        }
    }
}
