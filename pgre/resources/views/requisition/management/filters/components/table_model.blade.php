@php
    $header = [
        ['label' => 'Tag','width' => 10],
        ['label' => 'Estado','width' => 10],
        ['label' => 'Utilizador','width' => 10],
        ['label' => 'Data Pedido','width' => 20],
        ['label' => 'Curso','width' => 10],
        ['label' => 'Turma','width' => 10],
        ['label' => 'Ufcd','width' => 10],
        ['label' => 'Formador','width' => 10],
        ['label' => 'Ações', 'no-export' => false, 'width' => 5],
    ];
     //Config Botões
    $config['paging'] = true;
    $config['order'] = [[0, 'desc']];
    $config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];

//    $config["lengthMenu"] = [ 10, 50, 100, 500];
@endphp

<x-adminlte-datatable id="req_table_type_" :heads="$header" theme="light" head-theme="dark" :config="$config" striped hoverable with-buttons>
    @foreach($req_data as $req)
        <tr>
            <td>{{$req->tag}}</td>

            <td>@if (!$req->isExpired()) {{$req->requisition_level->name}} @else <span class="badge bg-danger p-2">Expirado</span> @endif</td>
            <td>{{$req->request_user->name}}</td>
            <td>{{$req->requested_at}}</td>
            <td>{{$req->course}}</td>
            <td>{{$req->class}}</td>
            <td>{{$req->ufcd}}</td>
            <td>{{$req->teacher}}</td>
            <td>
                <nobr>
                    <a href="/requisition-management/details/{{$req->id}}" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="Detalhes" > <i class="fa fa-lg fa-fw fa-eye"></i> </a>
                    @if($req->level_id == 2)
                        <a href="/requisition-management/show/{{$req->id}}" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="Editar" > <i class="fa fa-lg fa-fw fa-pen"></i> </a>
                    @endif
                </nobr>
            </td>
        </tr>
    @endforeach
</x-adminlte-datatable>
