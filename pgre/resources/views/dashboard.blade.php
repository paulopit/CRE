@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="mt-3">
{{--                @component('components.alerts')--}}
{{--                @endcomponent--}}
    </div>


@stop
@section('content')
    @include('sweetalert::alert')
    <div class="row">

        @if(count($expiring_requisition) > 0 || count($expired_requisition) > 0)
            @component('components.notifications', ['expiring_requisition' => $expiring_requisition, 'expired_requisition' => $expired_requisition])
            @endcomponent
                <button id="notification_btn" data-toggle="modal" title="Notificações"  data-target='#show_notifications' data-id="" class="kc_fab_main_btn notification_btn"><i class="fas fa-bell"></i></button>
        @endif

    @if (Auth::user()->can('front-permission'))
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count(Auth::user()->requisitions->where('level_id',2))}}" text="Por Aprovar" icon="fas fa-question-circle text-white"
                                      theme="warning" url="/requisitions/pending" url-text="Ver requisições"/>
            </div>
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count(Auth::user()->requisitions->where('level_id',3))}}" text="Por entregar" icon="fas fa-pause-circle text-white"
                                      theme="orange" url="/requisitions/pending" url-text="Ver requisições"/>
            </div>
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count(Auth::user()->requisitions->where('level_id',4))}}" text="Ativas" icon="fas fa-play-circle text-white"
                                      theme="success" url="/requisitions/active" url-text="View details"/>
            </div>
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count(Auth::user()->requisitions->whereIn('level_id', array(6,7, 8)))}}" text="Fechadas" icon="fas fa-stop-circle text-white"
                                      theme="danger" url="/requisitions/closed" url-text="View details"/>
            </div>

        @endif


        @if (Auth::user()->can('tech-permission') || Auth::user()->can('admin-permission')  )
                <div class="col-lg-3">
                    <x-adminlte-small-box title="{{count($requisitions->where('level_id',2))}}" text="Por Aprovar" icon="fas fa-question-circle text-white"
                                          theme="warning" url="/requisition-management/pending" url-text="Ver requisições"/>
                </div>
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count($requisitions->where('level_id',3))}}" text="Por Entregar" icon="fas fa-pause-circle text-white"
                                          theme="orange" url="/requisition-management/deliver" url-text="Ver requisições"/>
            </div>
            <div class="col-lg-3">
                        <x-adminlte-small-box title="{{count($requisitions->where('level_id',4))}}" text="Em empréstimo" icon="fas fa-play-circle text-white"
                                          theme="success" url="/requisition-management/active" url-text="Ver requisições"/>
            </div>
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count($requisitions->whereIn('level_id', array(6,7, 8)))}}" text="Fechadas" icon="fas fa-stop-circle text-white"
                                          theme="danger" url="/requisition-management/closed" url-text="Ver requisições"/>
            </div>
            @endif
    </div>


    <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Requisições abertas</h3>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->can('tech-permission') || Auth::user()->can('admin-permission')  )
                            @component('requisition.list.components.requisition_table', ['req_data' => $admin_open_req])
                            @endcomponent
                        @else
                            @component('requisition.list.components.requisition_table', ['req_data' => $user_open_req])
                            @endcomponent
                        @endif
                    </div>
                </div>
            </div>






    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

