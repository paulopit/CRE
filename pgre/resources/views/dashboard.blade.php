@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="mt-3">

    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <x-adminlte-small-box title="0" text="Total" icon="fas fa-ticket-alt text-white"
                                  theme="info" url="#" url-text="Ver requisições"/>
        </div>
        <div class="col-lg-3">
            <x-adminlte-small-box title="0" text="Pendentes" icon="fas fa-pause-circle text-white"
                                  theme="warning" url="#" url-text="Ver requisições"/>
        </div>
        <div class="col-lg-3">
            <x-adminlte-small-box title="0" text="Ativas" icon="fas fa-play-circle text-white"
                                  theme="success" url="#" url-text="View details"/>
        </div>
        <div class="col-lg-3">
            <x-adminlte-small-box title="0" text="Fechadas" icon="fas fa-stop-circle text-white"
                                  theme="danger" url="#" url-text="View details"/>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
