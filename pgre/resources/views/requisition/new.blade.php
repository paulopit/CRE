@extends('adminlte::page')

@section('title', 'GRE - Nova Requisição')

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
                    <h3 class="card-title">Nova Requisição </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('requisitions/create')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <x-adminlte-input name="user_name" label="Nome" placeholder="username" value="{{$user_req->name}}" fgroup-class="col-md-6" disabled="disabled">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-select name="user_function" label="Função" fgroup-class="col-md-6">
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
                            <x-adminlte-input name="req_course" label="Curso" placeholder="Curso" value="" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_class" label="Turma" placeholder="Turma" value="" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_ufcd" label="Nome UFCD" placeholder="UFCD" value="" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="req_teacher" label="Nome Formador" placeholder="Nome Formador" value="" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <hr>
                        <h5 class="pb-3"> Equipamentos </h5>
                        @php
                            $header = [
                                ['label' => 'ID','width' => 3],
                                ['label' => 'Referência','width' => 20],
                                ['label' => 'Descrição','width' => 20],
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
                        </x-adminlte-datatable>

                        <div class="mt-3">
                            <x-adminlte-button class="btn-flat" type="submit" label="Submeter" theme="secondary" icon="fas fa-lg fa-save"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

