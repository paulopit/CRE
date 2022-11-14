<div class="modal fade" id="extend_req_{{$req_details->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/requisition-management/extend_requisition')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Prolongar Devolução</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: none;">
                        <x-adminlte-input name="req_id" label="" placeholder="" value="{{$req_details->id}}" fgroup-class="col-md-12">
                        </x-adminlte-input>
                    </div>
                    <x-adminlte-input name="end_date" label="Limite Devolução" type="date" placeholder="" value="{{substr($req_details->end_date,0,10) }}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" data-dismiss="modal" label="Cancelar" theme="info" icon="fas fa-lg fa-times"/>
                    <x-adminlte-button class="btn-flat" type="submit" label="Submeter" theme="secondary" icon="fas fa-lg fa-check"/>
                </div>
            </form>
        </div>
    </div>
</div>
