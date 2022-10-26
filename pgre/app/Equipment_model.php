<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment_model extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
