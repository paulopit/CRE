<div class="modal fade" id="add_req_equip_{{$requisition_details->tag}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/equip-management/equipment/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar equipamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs" id="search_tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="ref_tab" data-toggle="tab" data-target="#ref" type="button" role="tab" aria-controls="ref" aria-selected="true">Por Referência</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="type_tab" data-toggle="tab" data-target="#type" type="button" role="tab" aria-controls="contact" aria-selected="false">Por tipo equipamento</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="ref" role="tabpanel" aria-labelledby="ref_tab">
                            <x-adminlte-input name="equip_ref" label="" placeholder="Referência" value="" fgroup-class="col-md-12">
                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="outline-success" label="Search" onclick="search_ref()" />
                                </x-slot>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-hashtag text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="tab-pane fade" id="type" role="tabpanel" aria-labelledby="type_tab">
                            <x-adminlte-select name="equip_type" label="" fgroup-class="col-md-12">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-toolbox text-lightblue"></i>
                                    </div>
                                </x-slot>
                                <option>-- Tipo Equipamento --</option>
                                @foreach($equip_types as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <hr/>
                        <label id="no_records_found" style="display: none">Nenhum registo encontrado!</label>
                        <div style="display: none;" id="sel_equip_div">
                            <x-adminlte-select name="sel_equipment" label="Equipamento" fgroup-class="col-md-12" >
                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="outline-success" label="Selecionar" onclick="store_equip()"/>
                                </x-slot>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-desktop text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function store_equip(){
        var equip_id = $('#sel_equipment').val();
        $.ajax({
            url: '/equip-management/equipment/add/{{$requisition_details->id}}/'+equip_id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                location.href = "/requisitions/new"
            }
        });
    }

    function search_ref(){
        var ref = $('#equip_ref').val();
        $('#no_records_found').hide();
        $("#sel_equipment").empty();
        $.ajax({
            url: '/getEquipmentsByRef/'+ref,
            type: 'get',
            dataType: 'json',
            success: function(response){
                var len = 0;
                if(response['data'] != null){
                    len = response['data'].length;
                }
                if(len > 0){
                    $('#sel_equip_div').show();
                    for(var i=0; i<len; i++){
                        var id = response['data'][i].id;
                        var reference = response['data'][i].reference;
                        var description = response['data'][i].description;
                        var option = "<option value='"+id+"'>"+reference+ " - " +description+"</option>";
                        $("#sel_equipment").append(option);
                    }
                }else{
                    $('#no_records_found').show();
                    $('#sel_equip_div').hide();
                }
            }
        });
    }

    $(document).ready(function(){
        $('#equip_type').change(function(){
            var type_id = $(this).val();
            $('#no_records_found').hide();
            $("#sel_equipment").empty();
            // AJAX request
            $.ajax({
                url: '/getEquipmentsByType/'+type_id,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                        $('#sel_equip_div').show();
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].id;
                            var reference = response['data'][i].reference;
                            var description = response['data'][i].description;
                            var option = "<option value='"+id+"'>"+reference+ " - " +description+"</option>";
                            $("#sel_equipment").append(option);
                        }
                    }else{
                        $('#sel_equip_div').hide();
                    }
                }
            });
        });
    });
</script>
