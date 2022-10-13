<div class="modal fade" id="edit_user_{{$user->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{url('/user-management/user/'. $user->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Editar utilizador {{$user->type_name}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-adminlte-input name="user_name" label="Nome" placeholder="Nome" value="{{$user->name}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input name="user_phone" label="Telefone" placeholder="Telefone" value="{{$user->phone}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-phone text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="user_birth_date" label="Data nascimento" type="date" placeholder="Data nascimento" value="{{$user->birth_date}}" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-select name="user_function" label="Função" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user-md text-lightblue"></i>
                            </div>
                        </x-slot>
                        @foreach($user_functions as $function)
                            <option value="{{$function->id}}" @if($function->id == $user->user_function_id) selected @endif >{{$function->function_name}}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select name="user_type" label="Tipo utilizador" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-sitemap text-lightblue"></i>
                            </div>
                        </x-slot>
                        @foreach($user_types as $type)
                            <option value="{{$type->id}}" @if($type->id == $user->user_type_id) selected @endif  @if($user->id == 1) disabled @endif >{{$type->type_name}}</option>
                        @endforeach
                    </x-adminlte-select>

                    @if($user->id != 1)
                        @if($user->is_active)
                            <x-adminlte-input-switch label="Ativo" name="user_active_{{$user->id}}" value="0" data-on-color="lightblue" data-off-color="secondary" checked/>
                        @else
                            <x-adminlte-input-switch label="Ativo" name="user_active_{{$user->id}}" value="0" data-on-color="lightblue" data-off-color="secondary"/>
                        @endif
                    @endif


                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" type="submit" label="Gravar" theme="secondary" icon="fas fa-lg fa-save"/>
                </div>
            </form>
        </div>
    </div>
</div>
