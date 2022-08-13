@extends('adminlte::page')
@section('title', 'type-chambres')

{{-- @section('content_header')
    <h1>Dashboard</h1>
@stop --}}

@section('content')
   <main>
         @livewire('type-chambres')
   </main>
@stop
{{-- @section('right-sidebar')
    <p>Welcome to this beautiful admin right-sidebar.</p>
@stop --}}

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    {{-- @vite(['resources/sass/app.scss']) --}}
@stop

@section('js')
{{-- @vite(['resources/js/app.js']) --}}
    <script> console.log('Hi!'); </script>
@stop

<script>
    window.addEventListener('showModalTypeChambre', event => {
        $("#staticBackdrop").modal('show');

    })
    window.addEventListener('hideModalTypeChambre', event => {
        $("#staticBackdrop").modal('hide');
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Operation effectuer avec succes',
            showConfirmButton: false,
            timer: 1500
            })
    })

    window.addEventListener('showModalss', event => {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
            });
    })
</script>
