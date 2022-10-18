<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function equipment_type()
    {
        return $this->hasOne(Equipment_type::class);
    }

    public function model()
    {
        return $this->hasOne(Model::class);
    }


}
