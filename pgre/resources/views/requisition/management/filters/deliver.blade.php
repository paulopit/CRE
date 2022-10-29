@extends('adminlte::page')

@section('title', 'GRE - Requisições por Entregar')

@section('content_header')
@stop

@section('content')
    @include('sweetalert::alert')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Requisições por Entregar</h3>
                </div>
                <div class="card-body">
                    @component('requisition.management.filters.components.table_model', ['req_data' => $deliver_req])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
