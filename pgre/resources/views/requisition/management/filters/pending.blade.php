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
                    @component('requisition.management.filters.components.table_model', ['req_data' => $pending_req])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
