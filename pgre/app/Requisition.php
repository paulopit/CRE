<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function requisition_level()
    {
        return $this->hasOne(Requisition_level::class);
    }


}
