<div class="modal fade" id="edit_equip_model_{{$equipment_model->id}}">
    <div class="modal-dialog modal-dialog-centered">\\
        <div class="modal-content">
            <form method="POST" action="{{url('/equip-management/models/'. $equipment_model->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Editar Modelo {{$equipment_model->name}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <x-adminlte-input name="model_name" label="Modelo" placeholder="Model" value="{{$equipment_model->name}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user-md text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-select name="brand" label="Marca" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-copyright text-lightblue"></i>
                            </div>
                        </x-slot>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" @if($brand->id == $equipment_model->brand_id) selected @endif >{{$brand->name}}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>


                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" type="submit" label="Gravar" theme="secondary" icon="fas fa-lg fa-save"/>
                </div>
            </form>
        </div>
    </div>
</div>
