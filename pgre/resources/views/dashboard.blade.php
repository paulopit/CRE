@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="mt-3">

    </div>
@stop

@section('content')


    <div class="row">

        @if (Auth::user()->can('front-permission'))
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count(Auth::user()->requisitions)}}" text="Total" icon="fas fa-ticket-alt text-white"
                                      theme="info" url="#" url-text="Ver requisições"/>
            </div>
            <div class="col-lg-3">
                <x-adminlte-small-box title="{{count(Auth::user()->requisitions->where('level_id',2))}}" text="Pendentes" icon="fas fa-pause-circle text-white"
                                      theme="warning" url="/requisitions/pending" url-text="Ver requisições"/>
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
                <x-adminlte-small-box title="{{count($requisitions)}}" text="Total" icon="fas fa-ticket-alt text-white"
                                          theme="info" url="#" url-text="Ver requisições"/>
            </div>
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

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
