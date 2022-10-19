<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition extends Model
{
    use SoftDeletes;
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function lines()
    {
        return $this->hasMany(Requisition_line::class);
    }

    public function requisition_level()
    {
        return $this->belongsTo(Requisition_level::class,'level_id');
    }

    public function request_user()
    {
        return $this->belongsTo(User::class,'request_user_id');
    }




    protected $dates = ['deleted_at'];

}
