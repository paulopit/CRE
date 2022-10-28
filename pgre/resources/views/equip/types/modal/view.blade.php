<div class="modal fade" id="view_type_equip_{{$equipment_type->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$equipment_type->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-adminlte-input name="model_name" label="Modelo" placeholder="Modelo" value="{{$equipment_type->type}}" disabled="disabled" fgroup-class="col-md-12">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="far fa-copyright text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
    </div>
</div>
