@extends('adminlte::page')

@section('title', 'GRE - Nova Requisição')

@section('content_header')
    <div class="mb-3">
        @component('components.alerts')
        @endcomponent
    </div>
    <x-adminlte-alert theme="success" id="success-alert" title="Sucesso" dismissable style="display:none">
        <label>Requisição submetida com sucesso!</label>
    </x-adminlte-alert>
@stop

@section('content')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Nova Requisição - {{$temp_req->tag}}</h3>
                </div>

                @component('requisition.new.modal.add', ['requisition_details' => $temp_req, 'equip_types' => $equip_types])
                @endcomponent
                <div class="card-body">
                        <div class="row">
                            <div class="row" style="display: none;">
                                <x-adminlte-input name="user_id" label="" placeholder="user_id" value="{{$user_req->id}}" fgroup-class="col-md-6">
                                </x-adminlte-input>
                                <x-adminlte-input name="req_id" label="" placeholder="req_id" value="{{$temp_req->id}}" fgroup-class="col-md-6">
                                </x-adminlte-input>
                            </div>
                            <x-adminlte-input name="user_name" label="Nome" placeholder="username" value="{{$user_req->name}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-select name="user_function" label="Função" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-md text-lightblue"></i>
                                    </div>
                                </x-slot>
                                @foreach($user_func as $function)
                                    <option value="{{$function->id}}" @if($function->id == $user_req->user_function_id) selected @endif >{{$function->function_name}}</option>
                                @endforeach
                            </x-adminlte-select>
                            <x-adminlte-input label="Telefone" name="user_phone" type="number" placeholder="Telefone" value="{{$user_req->phone}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input label="Email" name="user_email" type="email" placeholder="mail@example.com" value="{{$user_req->email}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-at text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="req_course" id="req_course" label="Curso" placeholder="Curso" value="{{$temp_req->course}}" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_class" id="req_class"  label="Turma" placeholder="Turma" value="{{$temp_req->class}}" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-graduation-cap text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_ufcd" id="req_ufcd"  label="Nome UFCD" placeholder="UFCD" value="{{$temp_req->ufcd}}" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-university text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_teacher" id="req_teacher"  label="Nome Formador" placeholder="Nome Formador" value="{{$temp_req->teacher}}" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-tie text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="row">
                            <x-adminlte-textarea name="req_obs" id="req_obs" rows="5"  label="Observações" placeholder="Observações" fgroup-class="col-md-12">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-info text-lightblue"></i>
                                    </div>
                                </x-slot>
                                {{$temp_req->obs}}
                            </x-adminlte-textarea>
                        </div>

                        <a href="" class="btn btn-xs mt-3 mb-3" title="Adicionar Equipamento" onclick="Update_req_fields()" data-toggle="modal" data-target='#add_req_equip_{{$temp_req->tag}}' data-id=""> <x-adminlte-button class="btn-flat" type="button" label="Adicionar Equipamento" theme="secondary" icon="fas fa-lg fa-plus"/></a>
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

                            // Config Botões
//                            $config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
//                                              <"row" <"col-12" tr> >
//                                              <"row" <"col-sm-12 d-flex justify-content-start" f> >';
                            $config['paging'] = false;
                            $config["lengthMenu"] = [ 10, 50, 100, 500];
                        @endphp

                        <x-adminlte-datatable id="req_lines" :heads="$header" theme="light" head-theme="dark" striped hoverable>
                            @foreach($temp_req->lines as $line)
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
{{--                                            @component('user.management.modal.edit', ['user' => $user, 'user_functions' =>$user_functions,'user_types' => $user_types])--}}
{{--                                            @endcomponent--}}
{{--                                            <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_user_{{$user->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>--}}

                                            {{--                                        @component('user.types.modal.view', ['user_type' => $type])--}}
                                            {{--                                        @endcomponent--}}
                                            {{--                                        <a href="" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="View" data-toggle="modal" data-target='#view_user_type_{{$type->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-eye"></i> </a>--}}
                                        </nobr>
                                    </td>
                                </tr>
                            @endforeach
                        </x-adminlte-datatable>
                        <div class="mt-3">
                            @if(count($temp_req->lines) > 0)
                                <x-adminlte-button class="btn-flat" id="submit_req" type="submit" label="Submeter" theme="secondary" icon="fas fa-lg fa-save" onclick="Submit_requisition()" />
                            @else
                                <x-adminlte-button class="btn-flat" type="submit" label="Submeter" theme="secondary" disabled="disabled" icon="fas fa-lg fa-save"/>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        function Submit_requisition(){
            var req_id = {{$temp_req->id}};
            $.ajax({
                type:'POST',
                url:"{{ route('submit_req') }}",
                data:{req_id:req_id, _token: '{{csrf_token()}}'},
                success:function(data){
                    $('#submit_req').attr("disabled", true);
                    $("#success-alert").show();
                    setTimeout(function() { window.location = '/requisitions/new'; }, 1000);
                }
            });
        }

        function Update_req_fields(){
            var req_id = {{$temp_req->id}};
            var req_course = $('#req_course').val();
            var req_class = $('#req_class').val();
            var req_ufcd = $('#req_ufcd').val();
            var req_teacher = $('#req_teacher').val();
            var req_obs = $('#req_obs').val();
            $.ajax({
                type:'POST',
                url:"{{ route('update_req_fields') }}",
                data:{req_id:req_id,req_course:req_course, req_class:req_class, req_ufcd:req_ufcd, req_teacher:req_teacher,req_obs:req_obs, _token: '{{csrf_token()}}'},
                success:function(data){
                }
            });
        }


    </script>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

