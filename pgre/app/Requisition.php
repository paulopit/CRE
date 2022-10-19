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
        return $this->hasOne(Requisition_level::class);
    }

    protected $dates = ['deleted_at'];

}
