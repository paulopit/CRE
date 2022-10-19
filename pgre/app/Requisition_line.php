<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition_line extends Model
{
    use SoftDeletes;
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    protected $dates = ['deleted_at'];
}
