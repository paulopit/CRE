<div class="modal fade" id="deny_req_{{$req_details->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/requisition-management/deny')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Rejeitar Requisição</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: none;">
                        <x-adminlte-input name="req_id" label="" placeholder="" value="{{$req_details->id}}" fgroup-class="col-md-12">
                        </x-adminlte-input>
                    </div>
                    <x-adminlte-textarea name="deny_rec_obs" id="deny_rec_obs" rows="3"  label="Motivo" placeholder="Motivo" fgroup-class="col-md-12">                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-file-alt text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-textarea>
                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" type="submit" label="Confirmar" theme="secondary" icon="fas fa-lg fa-save"/>
                </div>
            </form>
        </div>
    </div>
</div>
