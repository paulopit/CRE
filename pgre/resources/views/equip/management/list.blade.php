@extends('adminlte::page')

@section('title', 'GRE - Equipamentos')

@section('content_header')
    <div class="mb-3">
        @component('components.alerts')
        @endcomponent
    </div>
@stop

@component('equip.management.modal.add', ['brands' => $brands, 'equipment_models' => $equipment_models, 'equipment_types' => $equipment_types])
@endcomponent


@section('content')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Lista de Equipamentos </h3>
                    <label class="float-right add_record_btn"><a href="" data-toggle="modal" data-target='#add_equipment' data-id="" ><i class="fas fa-plus-square"></i></a></label>
                </div>
                <div class="card-body">
                    @php
                        $header = [
                            'ID',
                            ['label' => 'Nome','width' => 200],
                            ['label' => 'Serial Number','width' => 200],
                            ['label' => 'Estado','width' => 200],
                            ['label' => 'Tipo Equipamento','width' => 200],
                            ['label' => 'Modelo','width' => 200],
                            ['label' => 'Referencia','width' => 200],
                            ['label' => 'Observação','width' => 200],
                            ['label' => 'Ações', 'no-export' => false, 'width' => 5],
                        ];

                        // Config Botões
                        $config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
                                          <"row" <"col-12" tr> >
                                          <"row" <"col-sm-12 d-flex justify-content-start" f> >';
                        $config['paging'] = false;
                        $config["lengthMenu"] = [ 10, 50, 100, 500];
                    @endphp

                    <x-adminlte-datatable id="equip_brands" :heads="$header" theme="light" head-theme="dark" striped hoverable with-buttons>
                        @foreach($equipments as $equipment)
                            <tr>
                                <td>{{$equipment->id}}</td>
                                <td>{{$equipment->description}}</td>
                                <td>{{$equipment->serial_number}}</td>
                                @if ($equipment->status_ok == 1)
                                    <td style="color: green">Ok</td>
                                @elseif ($equipment->status_ok == 0)
                                    <td style="color: red">NOk</td>
                                @endif
                                @foreach($equipment_types as $equipment_type)
                                    @if($equipment_type->id == $equipment->equipment_type_id)
                                        <td>{{$equipment_type->type}}</td>
                                    @endif
                                @endforeach
                                @foreach($equipment_models as $equipment_model)
                                    @if($equipment_model->id == $equipment->equipment_model_id)
                                        <td>{{$equipment_model->name}}</td>
                                    @endif
                                @endforeach
                                <td>{{$equipment->reference}}</td>
                                <td>{{$equipment->obs}}</td>
                                <td>
                                    <nobr>
                                        @component('equip.management.modal.edit', ['equipment' => $equipment])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow table-btn" title="Edit" data-toggle="modal" data-target='#edit_equip_brand_{{$equipment->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-pen"></i> </a>
                                        @component('equip.management.modal.view', ['equipment' => $equipment])
                                        @endcomponent
                                        <a href="" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="View" data-toggle="modal" data-target='#view_equip_brand_{{$equipment->id}}' data-id=""> <i class="fa fa-lg fa-fw fa-eye"></i> </a>
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
