@if (session('alert-danger'))
    <script type="application/javascript">
        $.notify('{{ session('alert-danger') }}', "danger");
    </script>
@endif
@if (session('alert-success'))
    <script type="application/javascript">
        $.notify('{{ session('alert-success') }}', "success");
    </script>
@endif
