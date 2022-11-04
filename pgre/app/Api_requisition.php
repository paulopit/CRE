<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Api_requisition
{
    public string $tag;
    public string $request_user;
    public string $level;
    public int $request_days;
    public string $end_date;
    public string $obs;
    public string $course;
    public string $class;
    public string $ufcd;
    public string $teacher;
    public string $created_at;
    public string $created_by;
    public string $requested_at;
    public string $requested_by;
    public string $approved_at;
    public string $approved_by;
    public string $canceled_at;
    public string $canceled_by;
    public string $canceled_obs;
    public string $picked_up_at;
    public string $picked_up_by;
    public string $delivered_at;
    public string $delivered_by;
    public string $returned_at;
    public string $returned_by;
    public string $closed_at;
    public string $closed_by;
    //public array $equipments;

    public function __construct(Requisition $requisition) {
        $this->tag = $requisition->tag;
        $this->request_user = $requisition->request_user->name;
        $this->level = $requisition->requisition_level->name;
        $this->request_days = $requisition->request_days;
        $this->end_date = strval($requisition->end_date);
        $this->obs =$requisition->obs ?? "";
        $this->course =$requisition->course ?? "";
        $this->class =$requisition->class ?? "";
        $this->ufcd =$requisition->ufcd ?? "";
        $this->teacher =$requisition->teacher ?? "";
        $this->created_at =strval($requisition->created_at) ?? "";
        $this->created_by =$requisition->created_by_user->name ?? "";
        $this->requested_at =strval($requisition->requested_at) ?? "";
        $this->requested_by =$requisition->requested_by_user->name ?? "";
        $this->approved_at =strval($requisition->approved_at);
        $this->approved_by =$requisition->approved_by_user->name ?? "";
        $this->canceled_at =strval($requisition->canceled_at);
        $this->canceled_by =$requisition->canceled_by_user->name ?? "";
        $this->canceled_obs =$requisition->canceled_obs ?? "";
        $this->picked_up_at =strval($requisition->picked_up_at);
        $this->picked_up_by =$requisition->picked_up_by_user->name ?? "";
        $this->delivered_at =strval($requisition->delivered_at);
        $this->delivered_by =$requisition->delivered_by_user->name ?? "";
        $this->returned_at =strval($requisition->returned_at);
        $this->returned_by =$requisition->returned_at_name->name ?? "";
        $this->closed_at =strval($requisition->closed_at);
        $this->closed_by =$requisition->closed_at_name->name ?? "";

        $this->equipments = [];
        foreach($requisition->lines as $line){
            array_push($this->equipments, $line->equipment);
        }

    }

}
