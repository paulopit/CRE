<div class="modal fade" id="view_equip_info_{{$equipment->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$equipment->description}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="text-center col-md-12">
                            @if(isset($equipment->image_url))
                                <img class="profile-user-img img-responsive w-50" src="{{asset('storage/'.$equipment->image_url) }}" alt="User profile picture">
                            @endif
                        </div>
                    </div>
                    <x-adminlte-input name="reference" label="Referência" placeholder="Marca" value="{{$equipment->reference}}" fgroup-class="col-md-12" disabled="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="description" label="Descrição" placeholder="Descrição" value="{{$equipment->description}}" fgroup-class="col-md-12" disabled="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="serial_number" label="Nº Série" placeholder="Nº Série" value="{{$equipment->serial_number}}" fgroup-class="col-md-12" disabled="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-fingerprint text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="equipment_type" label="Tipo de equipamento" placeholder="Marca" value="{{$equipment->equipment_type->type}}" fgroup-class="col-md-12" disabled="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-toolbox text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input name="equipment_model" label="Modelo" placeholder="Marca" value="{{$equipment->equipment_model->name}}" fgroup-class="col-md-12" disabled="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-registered text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="obs" label="Observação" placeholder="Observação" value="{{$equipment->obs}}" fgroup-class="col-md-12" disabled="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-info text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    {{$equipment->equipment_images}}
                    <div class="col-md-12">
                        @if($equipment->status_ok)
                            <x-adminlte-input-switch label="Estado" data-on-text="Ok" data-off-text="NoK" name="status_ok_{{$equipment->id}}" data-on-color="lightblue" data-off-color="secondary" checked disabled/>
                        @else
                            <x-adminlte-input-switch label="Estado" data-on-text="Ok" data-off-text="NoK" name="status_ok_{{$equipment->id}}" data-on-color="lightblue" data-off-color="secondary" disabled=""/>
                        @endif
                    </div>
                    <div class="col-md-12">
                        @if($equipment->in_stock)
                            <x-adminlte-input-switch label="Stock" data-on-text="Sim" data-off-text="Não" name="in_stock_{{$equipment->id}}" data-on-color="lightblue" data-off-color="secondary" checked disabled/>
                        @else
                            <x-adminlte-input-switch label="Stock" data-on-text="Sim" data-off-text="Não" name="in_stock_{{$equipment->id}}" data-on-color="lightblue" data-off-color="secondary" disabled=""/>
                        @endif
                    </div>

                </div>
        </div>
    </div>
</div>
