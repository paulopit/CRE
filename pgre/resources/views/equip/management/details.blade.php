@extends('adminlte::page')

@section('title', 'SER - Equipamentos')

@section('content_header')
    <div class="mb-3">
    </div>
@stop

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-lg-7">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Detalhes Equipamento </h3>
                </div>
                <div class="card-body" style="height: 770px;overflow: auto">
                    @if (!$equipment_info->is_active)   <p class="rubber rubber_equip_view"> Inativo </p> @endif
                    <div class="row">
                        <div class="col-md-8">
                            <x-adminlte-input name="reference" label="Referência" placeholder="Marca" value="{{$equipment_info->reference}}" fgroup-class="col-md-12" disabled="">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-hashtag text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="description" label="Descrição" placeholder="Descrição" value="{{$equipment_info->description}}" fgroup-class="col-md-12" disabled="">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-hashtag text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="serial_number" label="Nº Série" placeholder="Nº Série" value="{{$equipment_info->serial_number}}" fgroup-class="col-md-12" disabled="">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-solid fa-fingerprint text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="equipment_type" label="Tipo de equipamento" placeholder="Marca" value="{{$equipment_info->equipment_type->type}}" fgroup-class="col-md-12" disabled="">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-toolbox text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="equipment_model" label="Modelo" placeholder="Marca" value="{{$equipment_info->equipment_model->name}}" fgroup-class="col-md-12" disabled="">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-registered text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="obs" label="Observação" placeholder="Observação" value="{{$equipment_info->obs}}" fgroup-class="col-md-12" disabled="">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-info text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            {{$equipment_info->equipment_images}}
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    @if($equipment_info->status_ok)
                                        <x-adminlte-input-switch label="Estado" data-on-text="Ok" data-off-text="NoK" name="status_ok_{{$equipment_info->id}}" data-on-color="lightblue" data-off-color="secondary" checked disabled/>
                                    @else
                                        <x-adminlte-input-switch label="Estado" data-on-text="Ok" data-off-text="NoK" name="status_ok_{{$equipment_info->id}}" data-on-color="lightblue" data-off-color="secondary" disabled=""/>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    @if($equipment_info->in_stock)
                                        <x-adminlte-input-switch label="Stock" data-on-text="Sim" data-off-text="Não" name="in_stock_{{$equipment_info->id}}" data-on-color="lightblue" data-off-color="secondary" checked disabled/>
                                    @else
                                        <x-adminlte-input-switch label="Stock" data-on-text="Sim" data-off-text="Não" name="in_stock_{{$equipment_info->id}}" data-on-color="lightblue" data-off-color="secondary" disabled=""/>
                                    @endif

                                </div>
                            </div>

                        </div>
                        <div class="text-center col-md-4 mt-4">
                            @if(isset($equipment_info->image_url))
                                <img class="profile-user-img img-responsive w-100" src="{{asset('storage/'.$equipment_info->image_url) }}" alt="User profile picture">
                            @else
                                <img class="profile-user-img img-responsive w-100" src="{{asset('storage/img/no_img.png') }}" alt="no_img">
                            @endif
                        </div>

                    </div>


                        <div class="col-md-12">
                            <a href="{{ url()->previous() }}">
                                <x-adminlte-button class="btn-flat" type="" label="Voltar" theme="secondary" icon="fas fa-lg fa-arrow-left"/>
                            </a>
                        </div>



                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Histórico Equipamento </h3>
                </div>
                <div class="card-body" style="height: 770px;overflow: auto">
                    <div class="timeline">
                        @if(count($equipment_history)>0)
                            @foreach($equipment_history as $requisition)
                                <div class="time-label mt-3">
                                    <span class="bg-info"><a href="/requisition-management/details/{{$requisition->id}}">{{$requisition->tag}}</a></span>
                                </div>

                                <div>
                                    <i class="fas fa-crosshairs bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$requisition->requested_at}}</span>
                                        <h3 class="timeline-header"><a href="#">{{$requisition->request_user->name}}</a> Requisitou o equipamento</h3>
                                    </div>
                                </div>
                                @if(isset($requisition->canceled_at))
                                    <div>
                                        <i class="fas fa-window-close bg-red"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> {{$requisition->canceled_at}}</span>
                                            <h3 class="timeline-header"><a href="#">{{$requisition->canceled_by_user->name}}</a> Cancelou a requisição</h3>
                                            <div class="timeline-body">
                                                Motivo de cancelamento: <b>{{$requisition->canceled_obs}}</b> </br>
                                                Equipamento retornou ao stock.
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($requisition->picked_up_at))
                                <div>
                                    <i class="fas fa-sign-out-alt bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$requisition->picked_up_at}}</span>
                                        <h3 class="timeline-header"><a href="#">{{$requisition->picked_up_by}}</a> Levantou o equipamento</h3>
                                        <div class="timeline-body">
                                            @foreach($requisition->lines as $line)
                                                @if($line->equipment_id == $equipment_info->id)
                                                    Estado no levantamento: <b> @if($line->delivery_status == 1) OK @else NOK @endif  </b></br>
                                                    @endif
                                                    @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(isset($requisition->returned_at))
                                    <div>
                                        <i class="fas fa-sign-in-alt bg-green"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> {{$requisition->returned_at}}</span>
                                            <h3 class="timeline-header"><a href="#">{{$requisition->returned_by}}</a> Devolveu o equipamento</h3>
                                            <div class="timeline-body">
                                                @foreach($requisition->lines as $line)
                                                    @if($line->equipment_id == $equipment_info->id)
                                                        Estado na devolução: <b> @if($line->return_status == 1) OK @else NOK @endif  </b></br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        @else
                            <p class="rubber_no_history"> Sem Historico </p>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
