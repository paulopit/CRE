<div class="modal fade" id="edit_equip_{{$equipment->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/equip-management/equipments/'. $equipment->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Editar Equipamento {{$equipment->description}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="text-center col-md-12">
                            @if(isset($equipment->image_url))
                                <img class="profile-user-img img-responsive w-50" src="{{asset('storage/'.$equipment->image_url) }}" alt="User profile picture">
                            @endif
                        </div>
                    </div>

                    <x-adminlte-input-file name="equip_image" label="Imagem" igroup-size="sm" fgroup-class="col-md-12" placeholder="Seleccione uma imagem...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>




                    <x-adminlte-input name="equip_reference" label="Referência" placeholder="Marca" value="{{$equipment->reference}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-hashtag text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="equip_description" label="Descrição" placeholder="Marca" value="{{$equipment->description}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-pen text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="equip_serialnumber" label="Serial Number" placeholder="Marca" value="{{$equipment->serial_number}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-fingerprint text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-select required name="equip_type" id="equi_type" label="Tipo de equipamento" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-toolbox text-lightblue"></i>
                            </div>
                        </x-slot>
                        <option value="" disabled selected>--- Selecione um tipo de equipamento ---</option>
                        @foreach($equipment_types as $equipment_type)
                            <option value="{{$equipment_type->id}}" @if($equipment->equipment_type_id == $equipment_type->id) selected @endif>{{$equipment_type->type}}</option>
                        @endforeach
                    </x-adminlte-select>


                    <x-adminlte-select required name="equip_brand" id="equip_brand_{{$equipment->id}}" label="Marca" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="far fa-registered text-lightblue"></i>
                            </div>
                        </x-slot>
                        <option value="" disabled >--- Selecione um marca ---</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" @if($equipment->equipment_model->brand->id == $brand->id) selected @endif >{{$brand->name}}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select required name="equip_model" id="equip_model_{{$equipment->id}}" label="Modelo" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="far fa-copyright text-lightblue"></i>

                            </div>
                        </x-slot>
                        @foreach($equipment_models as $equipment_model)
                            <option value="{{$equipment_model->id}}" @if($equipment->equipment_model->id == $equipment_model->id) selected @endif >{{$equipment_model->name}}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-textarea name="obs" id="obs" rows="5"  label="Observações" placeholder="Observações" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-info text-lightblue"></i>
                            </div>
                        </x-slot>
                        {{$equipment->obs}}
                    </x-adminlte-textarea>

                    @if($equipment->status_ok)
                        <x-adminlte-input-switch label="Estado" data-on-text="Ok" data-off-text="NoK" name="equip_status_ok_{{$equipment->id}}" data-on-color="lightblue" data-off-color="secondary" checked />
                    @else
                        <x-adminlte-input-switch label="Estado" data-on-text="Ok" data-off-text="NoK" name="equip_status_ok_{{$equipment->id}}" data-on-color="lightblue" data-off-color="secondary"/>
                    @endif

                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" type="submit" label="Gravar" theme="secondary" icon="fas fa-lg fa-save"/>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $("#equip_brand_{{$equipment->id}}").change(function(){
        var brand = $(this).val();
        //console.log(brand);
        $.ajax({
            url: "{{ route('get_models_info') }}?brand_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                var s = '';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }
                $("#equip_model_{{$equipment->id}}").html(s);

            }
        });
    });


</script>
