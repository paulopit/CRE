<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function equipment_type()
    {
        return $this->belongsTo(Equipment_type::class);
    }

    public function equipment_model()
    {
        return $this->belongsTo(Equipment_model::class);
    }

}
