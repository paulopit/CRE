<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition_level extends Model
{
    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }
}
