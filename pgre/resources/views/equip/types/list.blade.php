@extends('adminlte::page')

@section('title', 'SER - Modelos de Equipamentos')

@section('content_header')
    <div class="mb-3">
    </div>
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
                            ['label' => 'Tipo Equipamento','width' => 100],
                            ['label' => 'Ações', 'no-export' => false, 'width' => 5],
                        ];

                        // Config Botões
                        $config['paging'] = true;
                        $config["lengthMenu"] = [ 10, 50, 100, 500];
                        $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                    @endphp

                    <x-adminlte-datatable id="type_model" :heads="$header" theme="light" :config="$config" head-theme="dark" striped hoverable with-buttons>
                        @foreach($equipment_types as $equipment_type)
                            <tr>
                                <td>{{$equipment_type->type}}</td>
                                <td>
                                    <nobr>
                                        @component('equip.types.modal.edit', ['equipment_type' => $equipment_type, 'equipment_types' => $equipment_types])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_type_equip_{{$equipment_type->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>
                                        @component('equip.types.modal.delete', ['equipment_type' => $equipment_type])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="Delete" data-toggle="modal" data-target='#delete_type_equip_{{$equipment_type->id}}' data-id=""><i class="fa fa-lg fa-fw fa-trash"></i></a>
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

