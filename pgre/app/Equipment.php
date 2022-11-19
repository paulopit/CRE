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

    public function active_requisition_tag()
    {
        $req_tag = Requisition::join('requisition_lines', 'requisition_lines.requisition_id', '=', 'requisitions.id')
                                ->where('requisition_lines.equipment_id', $this->id)
                                ->where('requisition_lines.is_active', 1)
                                ->pluck('requisitions.tag')
                                ->first();
        return $req_tag;
    }
    public function active_requisition_id()
    {
        $req_id = Requisition::join('requisition_lines', 'requisition_lines.requisition_id', '=', 'requisitions.id')
            ->where('requisition_lines.equipment_id', $this->id)
            ->where('requisition_lines.is_active', 1)
            ->pluck('requisitions.id')
            ->first();
        return $req_id;
    }

}
