@extends('adminlte::page')

@section('title', 'GRE - Editar requisição ')

@section('content_header')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
@stop

@section('content')
    @include('sweetalert::alert')
            <div class="">
                <div class="col-lg-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title"> {{$req->tag}} - <span class="badge p-2 @if($req->level_id == 2) badge-warning @endif @if($req->level_id == 3) badge-success @endif @if($req->level_id > 3) badge-info @endif">{{$req->requisition_level->name}}</span> </h3>

                        </div>
                        <div class="card-body">
                            <div class="row" style="display: none;">
                                <x-adminlte-input name="user_id" id="user_id" label="" placeholder="user_id" value="{{$req->request_user_id}}" fgroup-class="col-md-6">
                                </x-adminlte-input>
                                <x-adminlte-input name="req_id" id="req_id" label="" placeholder="req_id" value="{{$req->id}}" fgroup-class="col-md-6">
                                </x-adminlte-input>
                            </div>
                            <div class="row">
                                <x-adminlte-input name="user_name" label="Nome" placeholder="username" value="{{$req->request_user->name}}" fgroup-class="col-md-6" disabled="disabled">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-user text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="user_function" label="Função" placeholder="Função" value="{{$req->request_user->user_type->type_name}}" fgroup-class="col-md-6" disabled="disabled">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-user-md text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input label="Telefone" name="user_phone" type="number" placeholder="Telefone" value="{{$req->request_user->phone}}" fgroup-class="col-md-6" disabled="disabled">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>

                                <x-adminlte-input label="Email" name="user_email" type="email" placeholder="mail@example.com" value="{{$req->request_user->email}}" fgroup-class="col-md-6" disabled="disabled">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-at text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="req_course" id="req_course" label="Curso" placeholder="Curso" value="{{$req->course}}" fgroup-class="col-md-3">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-book text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>

                                <x-adminlte-input name="req_class" id="req_class"  label="Turma" placeholder="Turma" value="{{$req->class}}" fgroup-class="col-md-3" >
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-graduation-cap text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>

                                <x-adminlte-input name="req_ufcd" id="req_ufcd"  label="Nome UFCD" placeholder="UFCD" value="{{$req->ufcd}}" fgroup-class="col-md-3">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-university text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>

                                <x-adminlte-input name="req_teacher" id="req_teacher"  label="Nome Formador" placeholder="Nome Formador" value="{{$req->teacher}}" fgroup-class="col-md-3" >
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-user-tie text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name=req_days id="req_days"  label="Nº Dias" placeholder="Nº Dias" value="{{$req->request_days}}" fgroup-class="col-md-3">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-hashtag text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="row">
                                <x-adminlte-textarea name="req_obs" id="req_obs" rows="5"  label="Observações" placeholder="Observações" fgroup-class="col-md-12" >
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-info text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                    {{$req->obs}}
                                </x-adminlte-textarea>
                            </div>

                            @component('requisition.new.modal.add', ['requisition_details' => $req, 'equip_types' => $equip_types])
                            @endcomponent
                            <a href="" class="btn btn-xs mt-3 mb-3" title="Adicionar Equipamento" onclick="Update_req_fields()" data-toggle="modal" data-target='#add_req_equip_{{$req->tag}}' data-id=""> <x-adminlte-button class="btn-flat" type="button" label="Adicionar Equipamento" theme="secondary" icon="fas fa-lg fa-plus"/></a>
                            <hr>
                            <h5 class="pb-3"> Equipamentos </h5>
                            @php
                                $header = [
                                    ['label' => 'Referência','width' => 10],
                                    ['label' => 'Descrição','width' => 30],
                                    ['label' => 'Estado','width' => 10],
                                    ['label' => 'Obs','width' => 20],
                                    ['label' => 'Ações', 'no-export' => false, 'width' => 5],
                                ];

                                $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                                $config['paging'] = false;
                                $config['lengthMenu'] = [ 10, 50, 100, 500];
                            @endphp

                            <x-adminlte-datatable id="req_lines" :heads="$header" theme="light" head-theme="dark" :config="$config" striped hoverable>
                                @foreach($req->lines as $line)
                                    <tr>
                                        <td>{{$line->equipment->reference}}</td>
                                        <td>{{$line->equipment->description}}</td>
                                        <td>@if($line->equipment->status_ok) <label style="color: green">OK</label> @else <label style="color: orange"> NOK </label> @endif</td>
                                        <td>{{$line->equipment->obs}}</td>
                                        <td>
                                            <nobr>
                                                @component('requisition.new.modal.delete', ['equip' => $line])
                                                @endcomponent
                                                <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="Remover" data-toggle="modal" data-target='#remove_req_equip_{{$line->id}}' data-id=""><i class="fa fa-lg fa-fw fa-trash"></i></a>
                                            </nobr>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                            <div class="mt-3">
                                @if(count($req->lines) > 0)
                                    <x-adminlte-button class="btn-flat" id="submit_req" type="submit" label="Submeter" theme="secondary" icon="fas fa-lg fa-save" onclick="Submit_requisition()" />
                                @else
                                    <x-adminlte-button class="btn-flat" type="submit" label="Submeter" theme="secondary" disabled="disabled" icon="fas fa-lg fa-save"/>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function Update_req_fields(){
        var req_id = {{$req->id}};
        var user_id = $('#user_id').val();
        //console.log('user_id: ' + user_id);
        var req_course = $('#req_course').val();
        var req_class = $('#req_class').val();
        var req_ufcd = $('#req_ufcd').val();
        var req_teacher = $('#req_teacher').val();
        var req_obs = $('#req_obs').val();
        var req_days = $('#req_days').val();
        $.ajax({
            type:'POST',
            url:"{{ route('manage_update_req_fields') }}",
            data:{user_id:user_id,req_id:req_id,req_course:req_course, req_class:req_class, req_ufcd:req_ufcd, req_teacher:req_teacher,req_obs:req_obs,req_days:req_days, _token: '{{csrf_token()}}'},
            success:function(data){
            }
        });
    }


    function Submit_requisition(){
        $("#submit_req").prop('disabled', true);
        var user_id = $('#user_id').val();
        Update_req_fields();

        Swal.fire({
            title: 'Sucesso!',
            text: 'Requisição editada com sucesso!',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(function (result) {
            location.reload();
        });
    }
</script>
