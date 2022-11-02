<div class="modal fade" id="import_models">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/equip-management/models/excel-import')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Importar modelos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-adminlte-input-file name="import_file" label="Ficheiro excel" igroup-size="sm" fgroup-class="col-md-12" placeholder="Seleccione um ficheiro..." accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
                <div class="modal-footer">
                    <a href="/equip-management/models/import-template" class="btn btn-info btn-flat"><i class="fas fa-lg fa-file-excel"></i> Template</a>
                    <x-adminlte-button class="btn-flat" type="submit" label="Importar" theme="secondary" icon="fas fa-lg fa-save"/>
                </div>
            </form>
        </div>
    </div>
</div>
