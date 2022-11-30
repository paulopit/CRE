<div class="modal fade" id="show_notifications">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" style="display: inline-block";>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Notificações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 200px;overflow:auto;">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Requisição</th>
                            <th>Data de entrega</th>
                            <th style="width: 40px">Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($expired_requisition as $expired)
                                <tr>
                                    <td> <a href="/requisitions/details/{{$expired->id}}" class="product-title">{{$expired->tag}}</a></td>
                                    <td>{{substr($expired->end_date,0,10) }}</td>
                                    <td><span class="badge bg-danger">Expirada</span></td>
                                </tr>
                            @endforeach
                            @foreach($expiring_requisition as $expiring)
                                <tr>
                                    <td> <a href="/requisitions/details/{{$expiring->id}}" class="product-title">{{$expiring->tag}}</a></td>
                                    <td>{{substr($expiring->end_date,0,10) }}</td>
                                    <td><span class="badge bg-warning">A expirar</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>













                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" data-dismiss="modal" label="Fechar" theme="info" icon="fas fa-lg fa-times"/>
                </div>
            </form>
        </div>
    </div>
</div>
