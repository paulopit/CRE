<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition_line extends Model
{
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
