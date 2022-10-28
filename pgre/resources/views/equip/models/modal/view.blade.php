<div class="modal fade" id="view_equip_model_{{$equipment_model->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$equipment_model->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-adminlte-input name="model_name" label="Modelo" placeholder="Modelo" value="{{$equipment_model->name}}" disabled="disabled" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="far fa-copyright text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>



                    <x-adminlte-select name="model_brand" label="Marca" disabled="disabled"  fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="far fa-registered text-lightblue"></i>
                            </div>
                        </x-slot>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" @if($brand->id == $equipment_model->brand_id) selected @endif >{{$brand->name}}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
        </div>
    </div>
</div>
