@if (session('success'))
    <x-adminlte-alert theme="success" title="Sucesso" dismissable>
        {{ session('success') }}
    </x-adminlte-alert>
@endif
@if (session('error'))
    <x-adminlte-alert theme="danger" title="Erro" dismissable>
        {{ session('error') }}
    </x-adminlte-alert>
@endif
