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
                    <h3 class="card-title">Requisições abertas </h3>
                </div>
                <div class="card-body">
                    @php
                        $header = [
                            ['label' => 'Tag','width' => 20],
                            ['label' => 'Estado','width' => 20],
                            ['label' => 'Data Requisição','width' => 20],
                            ['label' => 'Curso','width' => 20],
                            ['label' => 'Turma','width' => 20],
                            ['label' => 'UFCD','width' => 20],
                            ['label' => 'Professor','width' => 20],
                            ['label' => 'Ações','width' => 20],
                        ];

                        // Config Botões
                        $config['paging'] = true;
                        $config["lengthMenu"] = [5, 10, 50, 100, 500];
                        $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                    @endphp

                    <x-adminlte-datatable id="user_table" :heads="$header" theme="light" :config="$config"  head-theme="dark" striped hoverable with-buttons>
                        @foreach($user_req_lists_opened as $user_req_list_op)
                            <tr>
                                <td>{{$user_req_list_op->tag}}</td>
                                <td>{{$user_req_list_op->requisition_level->name}}</td>
                                <td>{{$user_req_list_op->requested_at}}</td>
                                <td>{{$user_req_list_op->course}}</td>
                                <td>{{$user_req_list_op->class}}</td>
                                <td>{{$user_req_list_op->ufcd}}</td>
                                <td>{{$user_req_list_op->teacher}}</td>
                                <td>
                                    <a href="{{url('/user-management/user/requisition/show/'.$user_req_list_op->id)}}" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="Ver Requisições" >
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Requisições fechadas </h3>
                </div>
                <div class="card-body">
                    @php
                        $header = [
                            ['label' => 'Tag','width' => 20],
                            ['label' => 'Estado','width' => 20],
                            ['label' => 'Data Requisição','width' => 20],
                            ['label' => 'Data conclusão','width' => 20],
                            ['label' => 'Curso','width' => 20],
                            ['label' => 'Turma','width' => 20],
                            ['label' => 'UFCD','width' => 20],
                            ['label' => 'Professor','width' => 20],
                            ['label' => 'Ações','width' => 20],

                        ];

                        // Config Botões
                        $config['paging'] = true;
                        $config["lengthMenu"] = [5, 10, 50, 100, 500];
                        $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                    @endphp

                    <x-adminlte-datatable id="user_table2" :heads="$header" theme="light" :config="$config"  head-theme="dark" striped hoverable with-buttons>
                        @foreach($user_req_lists_closed as $user_req_list_cl)
                            <tr>
                                <td>{{$user_req_list_cl->tag}}</td>
                                <td>{{$user_req_list_cl->requisition_level->name}}</td>
                                <td>{{$user_req_list_cl->requested_at}}</td>
                                <td>{{$user_req_list_cl->closed_at}}</td>
                                <td>{{$user_req_list_cl->course}}</td>
                                <td>{{$user_req_list_cl->class}}</td>
                                <td>{{$user_req_list_cl->ufcd}}</td>
                                <td>{{$user_req_list_cl->teacher}}</td>
                                <td>
                                    <a href="{{url('/user-management/user/requisition/show/'.$user_req_list_cl->id)}}" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="Ver Requisições" >
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
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
