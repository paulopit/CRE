<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_function extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'function_name'
    ];
}
