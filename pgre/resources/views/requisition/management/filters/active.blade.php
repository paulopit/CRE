@extends('adminlte::page')

@section('title', 'GRE - Requisições em Empréstimo')

@section('content_header')
    <div class="mt-3"></div>
@stop

@section('content')
    @include('sweetalert::alert')
    <div class="">
        <div class="col-lg-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Requisições em Empréstimo</h3>
                </div>
                <div class="card-body">
                    @component('requisition.management.filters.components.table_model', ['req_data' => $active_req])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
