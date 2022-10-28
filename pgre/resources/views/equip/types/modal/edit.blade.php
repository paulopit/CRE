<div class="modal fade" id="edit_type_equip_{{$equipment_type->id}}">
    <div class="modal-dialog modal-dialog-centered">\\
        <div class="modal-content">
            <form method="POST" action="{{url('/equip-management/types/'. $equipment_type->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Editar tipo de equipamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <x-adminlte-input name="type_name" label="Tipo de Equipamento" placeholder="Model" value="{{$equipment_type->type}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="far fa-copyright text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>


                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" type="submit" label="Gravar" theme="secondary" icon="fas fa-lg fa-save"/>
                </div>
            </form>
        </div>
    </div>
</div>
