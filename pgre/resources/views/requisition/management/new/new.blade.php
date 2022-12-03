@extends('adminlte::page')

@section('title', 'SER - Nova Requisição')

@section('content_header')
    <div class="mb-3">
{{--        @component('components.alerts')--}}
{{--        @endcomponent--}}
    </div>
@stop

@section('content')
    @include('sweetalert::alert')
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
                            <x-adminlte-input name="user_id" id="user_id" label="" placeholder="user_id" value="{{$temp_req->request_user_id}}" fgroup-class="col-md-6">
                            </x-adminlte-input>
                            <x-adminlte-input name="req_id" id="req_id" label="" placeholder="req_id" value="{{$temp_req->id}}" fgroup-class="col-md-6">
                            </x-adminlte-input>
                        </div>
                        <x-adminlte-select name="user_name" id="user_name" label="Utilizador" fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user-md text-lightblue"></i>
                                </div>
                            </x-slot>
                            <option value="" disabled selected>--- Selecione um utilizador ---</option>
                            @foreach($user_list as $user)
                                <option value="{{$user->id}}" @if($user->id == $temp_req->request_user_id) selected @endif >{{$user->name}}</option>
                            @endforeach
                        </x-adminlte-select>

                        @if(isset($assigned_usr))

                            <x-adminlte-input label="Função" name="user_function" id="user_function" type="text" placeholder="Função"  value="{{$assigned_usr->user_function->function_name}}"  fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-md text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input label="Telefone" name="user_phone" id="user_phone" type="number" placeholder="Telefone" value="{{$assigned_usr->phone}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input label="Email" name="user_email"  id="user_email" type="email" placeholder="mail@example.com" value="{{$assigned_usr->email}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-at text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                        @else
                            <x-adminlte-input label="Função" name="user_function" id="user_function" type="text" placeholder="Função"  value=""  fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-md text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input label="Telefone" name="user_phone" id="user_phone" type="number" placeholder="Telefone" value="" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input label="Email" name="user_email"  id="user_email" type="email" placeholder="mail@example.com" value="" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-at text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                        @endif


                        <x-adminlte-input name="req_course" id="req_course" label="Curso" placeholder="Curso" value="{{$temp_req->course}}" fgroup-class="col-md-3">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input name="req_class" id="req_class"  label="Turma" placeholder="Turma" value="{{$temp_req->class}}" fgroup-class="col-md-3">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-graduation-cap text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input name="req_ufcd" id="req_ufcd"  label="Nome UFCD" placeholder="UFCD" value="{{$temp_req->ufcd}}" fgroup-class="col-md-3">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-university text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input name="req_teacher" id="req_teacher"  label="Nome Formador" placeholder="Nome Formador" value="{{$temp_req->teacher}}" fgroup-class="col-md-3">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user-tie text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        <x-adminlte-input name="req_days" id="req_days"  label="Nº Dias" type="number" min="1" max="999" placeholder="Nº Dias" value="{{$temp_req->request_days ?? 1}}" fgroup-class="col-md-3">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-hashtag text-lightblue"></i>
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
                        $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                        $config['paging'] = false;
                        $config['lengthMenu'] = [ 10, 50, 100, 500];
                    @endphp

                    <x-adminlte-datatable id="req_lines" :heads="$header" theme="light" head-theme="dark" :config="$config" striped hoverable>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        $("#user_name").change(function(){
            var user_id = $(this).val();
            //console.log(user_id);
            $.ajax({
                url: "{{ route('get_user_info') }}?user_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $("#user_id").val(user_id);

                    $("#user_function").val(data.user_info[0].function_name);
                    $("#user_phone").val(data.user_info[0].phone);
                    $("#user_email").val(data.user_info[0].email);
                }
            });

        });


        function Submit_requisition(){
            $("#submit_req").prop('disabled', true);
            var req_id = {{$temp_req->id}};
            var user_id = $('#user_id').val();
            Update_req_fields();

            if(user_id == ""){
                Swal.fire({
                    title: 'Erro!',
                    text: 'Tem de assignar a um utilizador!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                }).then(function (result) {
                    $("#submit_req").prop('disabled', false);
                })
            }else{
                $.ajax({
                    type:'POST',
                    url:"{{ route('submit_req') }}",
                    data:{req_id:req_id, _token: '{{csrf_token()}}'},
                    success:function(data){

                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Requisição criada com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(function (result) {
                            location.reload();
                        })
                    }
                });
            }
        }

        function Update_req_fields(){
            var req_id = {{$temp_req->id}};
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
    </script>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

