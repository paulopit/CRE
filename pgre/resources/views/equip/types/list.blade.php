@extends('adminlte::page')

@section('title', 'GRE - Modelos de Equipamentos')

@section('content_header')

@stop

@component('equip.types.modal.add', ['equipment_types' => $equipment_types])
@endcomponent


@section('content')
    @include('sweetalert::alert')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tipos de  Equipamentos </h3>
                    <label class="float-right add_record_btn"><a href="" data-toggle="modal" data-target='#add_type_equip' data-id="" ><i class="fas fa-plus-square"></i></a></label>
                </div>
                <div class="card-body">
                    @php
                        $header = [
                            'ID',
                            ['label' => 'Tipo','width' => 100],
                            ['label' => 'Ações', 'no-export' => false, 'width' => 5],
                        ];

                        // Config Botões
                        $config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
                                          <"row" <"col-12" tr> >
                                          <"row" <"col-sm-12 d-flex justify-content-start" f> >';
                        $config['paging'] = false;
                        $config["lengthMenu"] = [ 10, 50, 100, 500];
                    @endphp

                    <x-adminlte-datatable id="type_model" :heads="$header" theme="light" head-theme="dark" striped hoverable with-buttons>
                        @foreach($equipment_types as $equipment_type)
                            <tr>
                                <td>{{$equipment_type->id}}</td>
                                <td>{{$equipment_type->type}}</td>
                                <td>
                                    <nobr>
                                        @component('equip.types.modal.edit', ['equipment_type' => $equipment_type, 'equipment_types' => $equipment_types])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_type_equip_{{$equipment_type->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>
                                        {{--                                        @component('equip.models.modal.delete', ['model' => $model])--}}
                                        {{--                                        @endcomponent--}}
                                        {{--                                        <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="Delete" data-toggle="modal" data-target='#delete_equip_model_{{$model->id}}' data-id=""><i class="fa fa-lg fa-fw fa-trash"></i></a>--}}
                                        @component('equip.types.modal.view', ['equipment_types' => $equipment_types, 'equipment_type' => $equipment_type])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="View" data-toggle="modal" data-target='#view_type_equip_{{$equipment_type->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-eye"></i> </a>
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

