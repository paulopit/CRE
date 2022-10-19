@extends('adminlte::page')

@section('title', 'GRE - Requisições Pendentes')

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
                    <h3 class="card-title">Requisições Pendentes</h3>
                </div>
                <div class="card-body">
                    @php
                        $header = [
                            ['label' => 'Data Pedido','width' => 10],
                            ['label' => 'Tag','width' => 10],
                            ['label' => 'Estado','width' => 10],
                            ['label' => 'Curso','width' => 10],
                            ['label' => 'Turma','width' => 10],
                            ['label' => 'Ufcd','width' => 10],
                            ['label' => 'Formador','width' => 10],
                            ['label' => 'Obs','width' => 20],
                            ['label' => 'Ações', 'no-export' => false, 'width' => 5],
                        ];
                         //Config Botões
                            $config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
                                              <"row" <"col-12" tr> >
                                              <"row" <"col-sm-12 d-flex justify-content-start" f> >';
                        $config['paging'] = false;
                        $config["lengthMenu"] = [ 10, 50, 100, 500];
                    @endphp

                    <x-adminlte-datatable id="pending_req" :heads="$header" theme="light" head-theme="dark" striped hoverable with-buttons>
                        @foreach($pending_req as $req)
                            <tr>
                                <td>{{$req->requested_at}}</td>
                                <td>{{$req->tag}}</td>
                                <td>{{$req->requisition_level->name}}</td>
                                <td>{{$req->course}}</td>
                                <td>{{$req->class}}</td>
                                <td>{{$req->ufcd}}</td>
                                <td>{{$req->teacher}}</td>
                                <td>{{$req->obs}}</td>
                                <td>
                                    <nobr>
                                        <a href="/requisitions/details/{{$req->id}}" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="Details" > <i class="fa fa-lg fa-fw fa-eye"></i> </a>
                                        {{--                                        @component('requisition.new.modal.delete', ['equip' => $line])--}}
                                        {{--                                        @endcomponent--}}
                                        {{--                                        <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="delete" data-toggle="modal" data-target='#remove_req_equip_{{$line->id}}' data-id=""><i class="fa fa-lg fa-fw fa-trash"></i></a>--}}
                                        {{--                                            @component('user.management.modal.edit', ['user' => $user, 'user_functions' =>$user_functions,'user_types' => $user_types])--}}
                                        {{--                                            @endcomponent--}}
                                        {{--                                            <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_user_{{$user->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>--}}
                                        {{--                                        @component('user.types.modal.view', ['user_type' => $type])--}}
                                        {{--                                        @endcomponent--}}

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
