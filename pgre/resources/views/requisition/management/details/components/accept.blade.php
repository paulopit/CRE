<div class="modal fade" id="accept_req_{{$req_details->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/requisition-management/confirm/')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Aprovar Requisição</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: none;">
                        <x-adminlte-input name="req_id" label="" placeholder="" value="{{$req_details->id}}" fgroup-class="col-md-12">
                        </x-adminlte-input>
                    </div>
                    <h5 class="modal-title">Tem a certeza que pretende aprovar a requisição?</h5>
                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" data-dismiss="modal" label="Não" theme="info" icon="fas fa-lg fa-times"/>
                    <x-adminlte-button class="btn-flat" type="submit" label="Sim" theme="secondary" icon="fas fa-lg fa-check"/>
                </div>
            </form>
        </div>
    </div>
</div>
