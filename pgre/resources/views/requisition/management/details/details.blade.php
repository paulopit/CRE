@extends('adminlte::page')

@section('title', 'GRE - Detalhe requisição ')

@section('content_header')
    <div class="mb-3">
        @component('components.alerts')
        @endcomponent
    </div>
@stop

@section('content')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"> {{$req_details->tag}} - <span class="badge p-2 @if($req_details->level_id == 2) badge-warning @endif @if($req_details->level_id == 3) badge-success @endif @if($req_details->level_id > 3) badge-info @endif">{{$req_details->requisition_level->name}}</span> </h3>
                </div>

                <div class="card-body">
                        <div class="row">
                            <x-adminlte-input name="user_name" label="Nome" placeholder="username" value="{{$req_details->request_user->name}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="user_function" label="Função" placeholder="Função" value="{{$req_details->request_user->user_type->type_name}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-md text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input label="Telefone" name="user_phone" type="number" placeholder="Telefone" value="{{$req_details->request_user->phone}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input label="Email" name="user_email" type="email" placeholder="mail@example.com" value="{{$req_details->request_user->email}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-at text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="req_course" id="req_course" label="Curso" placeholder="Curso" value="{{$req_details->course}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_class" id="req_class"  label="Turma" placeholder="Turma" value="{{$req_details->class}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-graduation-cap text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_ufcd" id="req_ufcd"  label="Nome UFCD" placeholder="UFCD" value="{{$req_details->ufcd}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-university text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_teacher" id="req_teacher"  label="Nome Formador" placeholder="Nome Formador" value="{{$req_details->teacher}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-tie text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="row">
                            <x-adminlte-textarea name="req_obs" id="req_obs" rows="5"  label="Observações" placeholder="Observações" fgroup-class="col-md-12" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-info text-lightblue"></i>
                                    </div>
                                </x-slot>
                                {{$req_details->obs}}
                            </x-adminlte-textarea>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-2">
                                <a href="{{ url()->previous() }}">
                                    <x-adminlte-button class="btn-flat" type="" label="Voltar" theme="secondary" icon="fas fa-lg fa-arrow-left"/>
                                </a>
                            </div>
                            <div class="col-lg-8">

                            </div>

                            @if($req_details->level_id == 2)
                                <div class="col-lg-2" style="display: flex; justify-content: flex-end">
                                    @component('requisition.management.details.components.deny', ['req_details' => $req_details])
                                    @endcomponent
                                    <a href="" title="Rejeitar" data-toggle="modal" style="margin-right: 10px" data-target='#deny_req_{{$req_details->id}}' data-id="">
                                        <x-adminlte-button class="btn-flat" type="" label="Rejeitar" theme="danger" icon="far fa-times-circle"/>
                                    </a>
                                    @component('requisition.management.details.components.accept', ['req_details' => $req_details])
                                    @endcomponent
                                    <a href="" title="Aceitar" data-toggle="modal" style="margin-right: 10px" data-target='#accept_req_{{$req_details->id}}' data-id="">
                                        <x-adminlte-button class="btn-flat" type="" label="Aceitar" theme="success" icon="fas fa-lg fa-check-double"/>
                                    </a>
                                </div>
                            @endif

                            @if($req_details->level_id == 3)
                                <div class="col-lg-2" style="display: flex; justify-content: flex-end">
                                    @component('requisition.management.details.components.deliver', ['req_details' => $req_details])
                                    @endcomponent
                                    <a href="" title="Entregar" data-toggle="modal" style="margin-right: 10px" data-target='#deliver_req_{{$req_details->id}}' data-id="">
                                        <x-adminlte-button class="btn-flat" type="" label="Registar entrega" theme="success" icon="fas fa-lg fa-check-double"/>
                                    </a>
                                </div>
                            @endif




                        </div>

                        <hr>
                        <h5 class="pb-3"> Equipamentos </h5>
                        @php
                            $header = [
                                ['label' => 'Referência','width' => 10],
                                ['label' => 'Descrição','width' => 20],
                                ['label' => 'Nº Série','width' => 10],
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
                            @foreach($req_details->lines as $line)
                                <tr>
                                    <td>{{$line->equipment->reference}}</td>
                                    <td>{{$line->equipment->description}}</td>
                                    <td>{{$line->equipment->serial}}</td>
                                    <td>@if($line->equipment->status_ok) <label style="color: green">OK</label> @else <label style="color: orange"> NOK </label> @endif</td>
                                    <td>{{$line->equipment->obs}}</td>
                                    <td>
                                        <nobr>
{{--                                            @component('requisition.new.modal.delete', ['equip' => $line])--}}
{{--                                            @endcomponent--}}
{{--                                            <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="delete" data-toggle="modal" data-target='#remove_req_equip_{{$line->id}}' data-id=""><i class="fa fa-lg fa-fw fa-trash"></i></a>--}}
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
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

