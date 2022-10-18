<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function lines()
    {
        return $this->belongsTo(Requisition_line::class);
    }

    public function requisition_level()
    {
        return $this->hasOne(Requisition_level::class);
    }


}
