<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment_image extends Model
{
    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
