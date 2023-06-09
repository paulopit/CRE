@extends('adminlte::page')

@section('title', 'SER - Equipamentos')

@section('content_header')
    <div class="mb-3">
    </div>
@stop

@component('equip.management.modal.add', ['brands' => $brands, 'equipment_models' => $equipment_models, 'equipment_types' => $equipment_types])
@endcomponent
@component('equip.management.modal.import')
@endcomponent

@section('content')
    @include('sweetalert::alert')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Lista de Equipamentos </h3>
                    <label class="float-right add_record_btn"><a href="" data-toggle="modal" data-target='#add_equipment' title="Criar equipamento" data-id="" ><i class="fas fa-plus-square"></i></a></label>
                    <label class="float-right add_record_btn" style="margin-right: 15px!important;"><a href="" data-toggle="modal" title="Importar por Excel" data-target='#import_equipments' data-id="" ><i class="fas fa-file-excel"></i></a></label>
                </div>
                <div class="card-body">
                    @php
                        $header = [

                            ['label' => 'Referencia','width' => 10],
                            ['label' => 'Descrição','width' => 25],
                            ['label' => 'Serial Number','width' => 10],
                            ['label' => 'Marca','width' => 10],
                            ['label' => 'Modelo','width' => 10],
                            ['label' => 'Tipo Equipamento','width' => 15],
                            ['label' => 'Estado','width' => 10],
                            ['label' => 'Disponibilidade','width' => 10],
                            ['label' => 'Ações', 'no-export' => false, 'width' => 5],
                        ];

                        // Config Botões
                        $config['paging'] = true;
                        $config["lengthMenu"] = [ 10, 50, 100, 500];
                        $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
                    @endphp

                    <x-adminlte-datatable id="equip_brands" :heads="$header" theme="light" head-theme="dark" :config="$config" striped hoverable with-buttons>
                        @foreach($equipments as $equipment)
                            <tr>
                                <td>{{$equipment->reference}}</td>
                                <td>{{$equipment->description}}</td>
                                <td>{{$equipment->serial_number}}</td>
                                <td>{{$equipment->equipment_model->brand->name}}</td>
                                <td>{{$equipment->equipment_model->name}}</td>
                                @foreach($equipment_types as $equipment_type)
                                    @if($equipment_type->id == $equipment->equipment_type_id)
                                        <td>{{$equipment_type->type}}</td>
                                    @endif
                                @endforeach
                                @if(!$equipment->is_active)
                                    <td></td>
                                @else
                                    @if($equipment->status_ok)
                                        <td style="color: green">OK</td>
                                    @else
                                        <td style="color: orange"> NOK </td>
                                    @endif
                                @endif
                                <td>

                                @if(!$equipment->is_active)
                                        <span class="badge bg-danger p-2 ml-3">Inativo</span>
                                    @else
                                        @if($equipment->in_stock)
                                            <span class="badge bg-success p-2 ml-3">Disponível</span>
                                        @else
                                            @if($equipment->active_requisition_tag() != null)
                                                <a href="/requisition-management/details/{{$equipment->active_requisition_id()}}"}}>
                                                    <span class="badge bg-info p-2 ml-3">{{$equipment->active_requisition_tag()}}</span>
                                                </a>
                                            @endif
                                        @endif
                                @endif
                                </td>
                                <td>
                                    <nobr>
                                        @component('equip.management.modal.edit', ['equipment' => $equipment, 'brands' => $brands, 'equipment_models' => $equipment_models, 'equipment_types' => $equipment_types])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_equip_{{$equipment->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>
                                        @component('equip.management.modal.view', ['equipment' => $equipment, 'equipment_models' => $equipment_models])
                                        @endcomponent
<!--                                        <a href="" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="View" data-toggle="modal" data-target='#view_equip_info_{{$equipment->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-eye"></i> </a>-->
                                            <a href="/equip-management/equipments/{{$equipment->id}}" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="View"> <i class="fa fa-lg fa-fw fa-eye"></i> </a>
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
