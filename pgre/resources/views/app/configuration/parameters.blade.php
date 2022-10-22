@extends('adminlte::page')

@section('title', 'GRE - Configurações')

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
                    <h3 class="card-title">Configurações da aplicação </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('/admin/app-config')}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <x-adminlte-input name="conf_alert_emails" label="Email Alertas" placeholder="Email Alertas" value="{{$app_config->conf_alert_emails}}" fgroup-class="col-md-12">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($app_config->conf_alert_emails_check)
                                            <x-adminlte-input-switch label="Ativo" data-on-color="lightblue" data-off-color="secondary" name="conf_alert_emails_check" checked />
                                        @else
                                            <x-adminlte-input-switch label="Ativo" data-on-color="lightblue" data-off-color="secondary" name="conf_alert_emails_check" />
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <x-adminlte-input name="conf_low_stock_value" label="Percentagem alerta stock baixo" type="number" min="1" max="99" placeholder="Valor Percentagem" value="{{$app_config->conf_low_stock_percentage}}" fgroup-class="col-md-12">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-box text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($app_config->conf_low_stock_percentage_check)
                                            <x-adminlte-input-switch label="Ativo" name="conf_low_stock_check" data-on-color="lightblue" data-off-color="secondary" checked/>
                                        @else
                                            <x-adminlte-input-switch label="Ativo" name="conf_low_stock_check" data-on-color="lightblue" data-off-color="secondary"/>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <x-adminlte-input name="conf_default_req_days" label="Limite dias requisições" type="number" min="1" max="999" placeholder="Valor dias" value="{{$app_config->conf_default_req_days}}" fgroup-class="col-md-12">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-box text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($app_config->conf_default_req_days_check)
                                            <x-adminlte-input-switch label="Ativo" name="conf_default_req_days_check" data-on-color="lightblue" data-off-color="secondary" checked/>
                                        @else
                                            <x-adminlte-input-switch label="Ativo" name="conf_default_req_days_check" data-on-color="lightblue" data-off-color="secondary"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <x-adminlte-input name="conf_default_expire_minutes" label="Expira Requisição (minutos)" type="number" min="1" max="9999" placeholder="Valor minutos" value="{{$app_config->conf_default_expire_minutes}}" fgroup-class="col-md-12">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-box text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($app_config->conf_default_expire_minutes_check)
                                            <x-adminlte-input-switch label="Ativo" name="conf_default_expire_minutes_check" data-on-color="lightblue" data-off-color="secondary" checked/>
                                        @else
                                            <x-adminlte-input-switch label="Ativo" name="conf_default_expire_minutes_check" data-on-color="lightblue" data-off-color="secondary"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>

                        <x-adminlte-button class="btn-flat mt-3" type="submit" label="Atualizar" theme="secondary" icon="fas fa-lg fa-save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

