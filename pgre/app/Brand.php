<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function equipment_models()
    {
        return $this->hasMany(Equipment_model::class);
    }
}
