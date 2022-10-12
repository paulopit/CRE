<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment_type extends Model
{
    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
