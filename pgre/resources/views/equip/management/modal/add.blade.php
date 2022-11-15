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
                    <x-adminlte-input name="reference" id="reference" label="Referencia" placeholder="Referencia" value="" fgroup-class="col-md-12">
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



                    <x-adminlte-input name="serial_number" label="Nº Série" placeholder="Nº Série" value="" fgroup-class="col-md-12">
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
                        <option value="0" disabled selected>--- Selecione um tipo de equipamento ---</option>
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
                    <option value="0" disabled selected>--- Selecione um marca ---</option>
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
                            <option value="0" disabled selected>--- Selecione um modelo ---</option>
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



<style>
    select[readonly] {
        background: #eee;
        pointer-events: none;
        touch-action: none;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $("#brand_model").change(function(){
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


    function LoadModels(){
        $.ajax({
            url: "{{ route('get_models_info') }}?brand_id=" + $("#brand_model").val(),
            method: 'GET',
            success: function(data) {
                var s = '';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }
                $("#models_select").html(s);
            }
        });
    }


    $("#reference").focusout(function() {
        $("#description").removeAttr("readonly");
        $("#description").val('');

        $("#equipment_type").removeAttr("readonly");
        $("#equipment_type").val(0);

        $("#brand_model").removeAttr("readonly");
        $("#brand_model").val(0);

        $("#models_select").removeAttr("readonly");
        $("#models_select").empty();
        $.ajax({
            url: "{{ route('get_equip_data') }}?reference=" + $(this).val(),
            method: 'GET',
            success: function(data) {

                if(data.id != null){ //apenas preenche se devolver resultados.
                    $("#description").val(data.description);
                    $("#description").attr("readonly", "readonly");

                    $("#equipment_type").val(data.equipment_type_id);
                    $("#equipment_type").attr("readonly", "readonly");

                    $("#brand_model").val(data.equipment_model.brand_id);
                    $("#brand_model").attr("readonly", "readonly");
                    LoadModels();

                    $("#models_select").val(data.equipment_model_id);
                    $("#models_select").attr("readonly", "readonly");

                }
            }
        });
    });
</script>
