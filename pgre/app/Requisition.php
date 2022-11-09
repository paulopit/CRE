<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition extends Model
{
    use SoftDeletes;

    public function isExpired(){
        $expired = false;
        if($this->level_id == 4 && $this->end_date < now())
            $expired = true;
        return $expired;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function lines()
    {
        return $this->hasMany(Requisition_line::class);
    }

    public function requisition_level()
    {
        return $this->belongsTo(Requisition_level::class,'level_id');
    }

    public function request_user()
    {
        return $this->belongsTo(User::class,'request_user_id');
    }
    public function approved_by_user()
    {
        return $this->belongsTo(User::class,'approved_by');
    }
    public function canceled_by_user()
    {
        return $this->belongsTo(User::class,'canceled_by');
    }
    public function picked_up_by_user()
    {
        return $this->belongsTo(User::class,'picked_up_by');
    }
    public function delivered_by_user()
    {
        return $this->belongsTo(User::class,'delivered_by');
    }
    public function requested_by_user()
    {
        return $this->belongsTo(User::class,'requested_by');
    }
    public function created_by_user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function closed_by_user()
    {
        return $this->belongsTo(User::class,'closed_by');
    }
    protected $dates = ['deleted_at'];

}
