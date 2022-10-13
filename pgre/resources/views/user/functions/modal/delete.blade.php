<div class="modal fade" id="delete_user_function_{{$user_function->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('/user-management/functions/' . $user_function->id)}}" method="POST" style="display: inline-block";>
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar função </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title">Tem a certeza que pretende apagar o registo?</h5>
                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" data-dismiss="modal" label="Não" theme="info" icon="fas fa-lg fa-times"/>
                    <x-adminlte-button class="btn-flat" type="submit" label="Sim" theme="secondary" icon="fas fa-lg fa-check"/>
                </div>
            </form>
        </div>
    </div>
</div>
