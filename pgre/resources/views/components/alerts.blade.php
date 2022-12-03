@if (session('success'))
      <body onload="sucess_msg('{{ session('success') }}')">
@endif
@if (session('error'))
    <body onload="errormsg('{{ session('error') }}')">
@endif

<script>

    function sucess_msg($msg){
        Swal.fire({
            title: 'Sucesso!',
            text: $msg,
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then(function (result) {
            location.reload();
        })
    }
    function error_msg($msg){
        Swal.fire({
            title: 'Erro!',
            text: $msg,
            icon: 'error',
            confirmButtonText: 'Ok'
        }).then(function (result) {
            location.reload();
        })
    }
</script>
