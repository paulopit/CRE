@php
    $header = [
        ['label' => 'Data Pedido','width' => 15],
        ['label' => 'Tag','width' => 10],
        ['label' => 'Estado','width' => 10],
        ['label' => 'Utilizador','width' => 10],
        ['label' => 'Curso','width' => 10],
        ['label' => 'Turma','width' => 10],
        ['label' => 'Ufcd','width' => 10],
        ['label' => 'Formador','width' => 10],
        ['label' => 'Obs','width' => 20],
        ['label' => 'Ações', 'no-export' => false, 'width' => 5],
    ];
     //Config Botões
    $config['paging'] = true;
    $config['order'] = [[0, 'desc']];
//    $config["lengthMenu"] = [ 10, 50, 100, 500];
@endphp

<x-adminlte-datatable id="req_table_type_" :heads="$header" theme="light" head-theme="dark" :config="$config" striped hoverable with-buttons>
    @foreach($req_data as $req)
        <tr>
            <td>{{$req->requested_at}}</td>
            <td>{{$req->tag}}</td>
            <td>{{$req->requisition_level->name}}</td>
            <td>{{$req->request_user->name}}</td>
            <td>{{$req->course}}</td>
            <td>{{$req->class}}</td>
            <td>{{$req->ufcd}}</td>
            <td>{{$req->teacher}}</td>
            <td>{{$req->obs}}</td>
            <td>
                <nobr>
                    <a href="/requisition-management/details/{{$req->id}}" class="btn btn-xs btn-default text-teal mx-1 shadow table-btn" title="Detalhes" > <i class="fa fa-lg fa-fw fa-eye"></i> </a>
{{--                    @component('requisition.list.components.modal.delete', ['requisition' => $req])--}}
{{--                    @endcomponent--}}
{{--                    @if($req->level_id == 2)--}}
{{--                        <a href="" class="btn btn-xs btn-default text-danger mx-1 shadow table-btn" title="Cancelar" data-toggle="modal" data-target='#cancel_requisition_{{$req->id}}' data-id=""><i class="fa fa-lg fa-fw fa-trash"></i></a>--}}
{{--                    @endif--}}
                </nobr>
            </td>
        </tr>
    @endforeach
</x-adminlte-datatable>
