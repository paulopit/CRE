<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.~z
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birth_date', 'user_function_id','user_type_id', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_function()
    {
        return $this->belongsTo(User_function::class);
    }

    public function user_type()
    {
        return $this->belongsTo(User_type::class);
    }

    public function requisitions()
    {
        return $this->hasMany(Requisition::class,'request_user_id');
    }

    public function requisition_lines()
    {
        return $this->hasMany(Requisition_line::class);
    }

    public function isAdmin()
    {
        $admin = false;
        if(Auth::user() &&  Auth::user()->user_type_id == 1)
            $admin = true;
        return $admin;
    }

    public function isTechnician()
    {
        $tech = false;
        if(Auth::user() &&  Auth::user()->user_type_id == 2)
            $tech = true;
        return $tech;
    }

    public function isManager()
    {
        $manager = false;
        if(Auth::user() &&  Auth::user()->user_type_id < 3)
            $manager = true;
        return $manager;
    }

    public function isAutenticated()
    {
        return Auth::user();
    }

    public function isFrontUser()
    {
        $user = false;
        if(Auth::user() &&  Auth::user()->user_type_id > 2)
            $user = true;
        return $user;
    }

    protected $dates = ['deleted_at'];

}
