<div class="modal fade" id="view_equip_brand_{{$brand->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$brand->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-adminlte-input name="brand_name" label="" placeholder="Marca" value="{{$brand->name}}" disabled="disabled" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user-md text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
        </div>
    </div>
</div>
