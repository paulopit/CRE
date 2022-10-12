<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition_line extends Model
{
    public function requisition()
    {
        return $this->hasOne(Requisition::class);
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
