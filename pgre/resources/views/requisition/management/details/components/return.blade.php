<div class="modal fade" id="return_req_{{$req_details->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/requisition-management/register_return')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Registar Devolução</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: none;">
                        <x-adminlte-input name="req_id" label="" placeholder="" value="{{$req_details->id}}" fgroup-class="col-md-12">
                        </x-adminlte-input>
                    </div>

                    <x-adminlte-input name="req_return_name" label="Devolvido por" placeholder="Devolvido por" value="{{$req_details->request_user->name}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    @if(count($req_details->lines) > 0)
                        <hr/>
                        <label>Estado equipamentos</label>
                        <div class="row">
                            @foreach($req_details->lines as $equip)
                                <div class="col-lg-12">
                                    @if($equip->equipment->status_ok)
                                        <x-adminlte-input-switch data-on-text="OK" data-off-text="NOK" label="{{$equip->equipment->reference}} - {{$equip->equipment->description}}" name="equipment_status_{{$equip->equipment_id}}" data-on-color="lightblue" data-off-color="secondary" checked/>
                                    @else
                                        <x-adminlte-input-switch data-on-text="OK" data-off-text="NOK" label="{{$equip->equipment->reference}} - {{$equip->equipment->description}}" name="equipment_status_{{$equip->equipment_id}}" data-on-color="lightblue" data-off-color="secondary"/>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" data-dismiss="modal" label="Cancelar" theme="info" icon="fas fa-lg fa-times"/>
                    <x-adminlte-button class="btn-flat" type="submit" label="Submeter" theme="secondary" icon="fas fa-lg fa-check"/>
                </div>
            </form>
        </div>
    </div>
</div>
