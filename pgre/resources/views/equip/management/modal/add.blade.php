<div class="modal fade" id="add_equipment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/equip-management/equipments/add')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar equipamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <x-adminlte-input name="reference" label="Reference" placeholder="Reference" value="" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-hashtag text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input  name="description" label="Descrição" placeholder="Descrição" value="" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-pen text-lightblue"></i>

                            </div>
                        </x-slot>
                    </x-adminlte-input>



                    <x-adminlte-input name="serial_number" label="Nº Série" placeholder="Serial Number" value="" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-fingerprint text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-select  name="equipment_type" id="equipment_type" label="Tipo de equipamento" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-toolbox text-lightblue"></i>
                            </div>
                        </x-slot>
                        <option value="" disabled selected>--- Selecione um tipo de equipamento ---</option>
                        @foreach($equipment_types as $equipment_type)
                            <option value="{{$equipment_type->id}}">{{$equipment_type->type}}</option>
                        @endforeach
                    </x-adminlte-select>


                <x-adminlte-select  name="brand" id="brand_model" label="Marca" fgroup-class="col-md-12">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="far fa-registered text-lightblue"></i>
                        </div>
                    </x-slot>
                    <option value="" disabled selected>--- Selecione um marca ---</option>
                    @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select  name="models_select" id="models_select" label="Modelos" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="far fa-copyright text-lightblue"></i>

                            </div>
                        </x-slot>
                            <option value="" disabled selected>--- Selecione um modelo ---</option>
                </x-adminlte-select>

                <x-adminlte-input-file name="equip_image" label="Imagem" igroup-size="sm" fgroup-class="col-md-12" placeholder="Seleccione uma imagem...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                </x-adminlte-input-file>



                <x-adminlte-textarea name="obs" id="obs" rows="5"  label="Observações" placeholder="Observações" fgroup-class="col-md-12">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-info text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-textarea>

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
    $("#brand_model").change(function(){
        var brand = $(this).val();
        console.log(brand);
        $.ajax({
            url: "{{ route('get_models_info') }}?brand_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                var s = '';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }
                $("#models_select").html(s);

            }
        });
    });
</script>
