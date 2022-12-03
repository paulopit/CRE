@extends('adminlte::page')

@section('title', 'SER - Funções Utilizadores')

@section('content_header')
    <div class="mb-3">
    </div>
@stop

@component('user.functions.modal.add')
@endcomponent


@section('content')
    @include('sweetalert::alert')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Funções Utilizadores </h3>
                    <label class="float-right add_record_btn"><a href="" data-toggle="modal" data-target='#add_user_function' data-id="" ><i class="fas fa-plus-square"></i></a></label>
                </div>
                <div class="card-body">
                    @php
                        $header = [
                            'ID',
                            ['label' => 'Função','width' => 200],
                            ['label' => 'Ações', 'no-export' => false, 'width' => 5],
                        ];

                        // Config Botões
                        $config['paging'] = false;
                        $config["lengthMenu"] = [ 10, 50, 100, 500];
                        $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                    @endphp

                    <x-adminlte-datatable id="user_functions" :heads="$header" theme="light" :config="$config" head-theme="dark" striped hoverable with-buttons>
                        @foreach($user_functions as $function)
                            <tr>
                                <td>{{$function->id}}</td>
                                <td>{{$function->function_name}}</td>
                                <td>
                                    <nobr>
                                        @component('user.functions.modal.edit', ['user_function' => $function])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_user_function_{{$function->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>
                                        @component('user.functions.modal.delete', ['user_function' => $function])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="delete" data-toggle="modal" data-target='#delete_user_function_{{$function->id}}' data-id=""><i class="fa fa-lg fa-fw fa-trash"></i></a>
                                        @component('user.functions.modal.view', ['user_function' => $function])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="View" data-toggle="modal" data-target='#view_user_function_{{$function->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-eye"></i> </a>
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

