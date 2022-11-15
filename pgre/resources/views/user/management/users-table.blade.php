@extends('adminlte::page')

@section('title', 'GRE - Gestão Utilizadores')

@section('content_header')
    <div class="mb-3">
    </div>
@stop

@section('content')
    @include('sweetalert::alert')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"> Gestão Utilizadores </h3>
                </div>
                <div class="card-body">
                    @php
                        $header = [
                            'ID',
                            ['label' => 'Nome','width' => 30],
                            ['label' => 'Telefone','width' => 20],
                            ['label' => 'Função','width' => 20],
                            ['label' => 'Tipo','width' => 20],
                            ['label' => 'Email','width' => 20],
                            ['label' => 'Ativo','width' => 5],
                            ['label' => 'Ações', 'no-export' => false, 'width' => 5],

                        ];

                        // Config Botões
                        $config['paging'] = true;
                        $config["lengthMenu"] = [ 10, 50, 100, 500];
                        $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                    @endphp

                    <x-adminlte-datatable id="user_table" :heads="$header" theme="light" :config="$config"  head-theme="dark" striped hoverable with-buttons>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->user_function->function_name}}</td>
                                <td>{{$user->user_type->type_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>@if($user->is_active == 1) Sim @else Não @endif</td>
                                <td>
                                    <nobr>
                                        @component('user.management.modal.edit', ['user' => $user, 'user_functions' =>$user_functions,'user_types' => $user_types])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_user_{{$user->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>
{{--                                        @component('user.types.modal.delete', ['user_type' => $type])--}}
{{--                                        @endcomponent--}}
{{--                                        <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="delete" data-toggle="modal" data-target='#delete_user_type_{{$type->id}}' data-id="" @if($type->id < 4)  style="pointer-events:none;cursor:default;background: #dddddd;" @endif><i class="fa fa-lg fa-fw fa-trash"></i></a>--}}
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

