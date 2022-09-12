@extends('adminlte::page')
@section('title', 'liste-reservations')

{{-- @section('content_header')
    <h1>Dashboard</h1>
@stop --}}

@section('content')
   <main>
         @livewire('liste-reservations')
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
    window.addEventListener('showModalReservation', event => {
        $("#modalReservation").modal('show');

    });
    window.addEventListener('hideModalChambre', event => {
        $("#staticBackdrop").modal('hide');
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Operation effectuer avec succes',
            showConfirmButton: false,
            timer: 1500
            })
    });


    window.addEventListener('comfirmation', event => {
        // $("#staticBackdrop").modal('hide');
        Swal.fire({
            title: 'Comfirmation ?',
            text: "Voulez vous vraiment comfirmer la reservation  ?",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Comfimer',
            cancelButtonText: 'Annuler',
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit("comfirmationSucess")
            }
            })
        });
        window.addEventListener('comfirmationS', event => {
        // $("#staticBackdrop").modal('hide');
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            toast:true,
            title: 'Operation effectuer avec succes',
            showConfirmButton: false,
            timer: 3000
            })

        });

        window.addEventListener('delete', event => {
        // $("#staticBackdrop").modal('hide');
        Swal.fire({
            title: 'Suppression?',
            text: "Voulez vous vraiment supprimé la reservation!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui!',
            cancelButtonText: 'Annuler',
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit("deleteSucess")
            }
            })
        });
        window.addEventListener('deleteS', event => {
        // $("#staticBackdrop").modal('hide');
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            toast:true,
            title: 'Supprimer avec succes',
            showConfirmButton: false,
            timer: 3000
            })

        });

</script>
