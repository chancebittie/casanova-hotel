<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    @livewire('login')
    {{-- <div class="container py-auto">
        <div class="card col-md-6 mx-auto mt-5">

            <div class="col-md-10 mt-3  mx-auto">
                <div class="input-group has-validation">
                    <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                    <div class="form-floating ">
                      <input type="text" class="form-control " id="floatingInputGroup2" placeholder="Nom" required>
                      <label for="floatingInputGroup2">Nom</label>
                    </div>
                    <div class="invalid-feedback">
                      Please choose a username.
                    </div>
                  </div>
            </div>

            <div class="col-md-10 mt-3  mx-auto">
                <div class="input-group has-validation">
                    <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                    <div class="form-floating ">
                      <input type="text" class="form-control " id="floatingInputGroup2" placeholder="Pseudo" required>
                      <label for="floatingInputGroup2">Pseudo</label>
                    </div>
                    <div class="invalid-feedback">
                      Please choose a username.
                    </div>
                  </div>
            </div>

            <div class="col-md-10 mt-3  mx-auto">
                <div class="input-group has-validation">
                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                    <div class="form-floating ">
                      <input type="text" class="form-control " id="floatingInputGroup2" placeholder="password" required>
                      <label for="floatingInputGroup2">Mots de passe</label>
                    </div>
                    <div class="invalid-feedback">
                      Please choose a username.
                    </div>
                  </div>
            </div>

            <div class="col-md-10 mt-3  mx-auto">
                <div class="input-group has-validation">
                    <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
                    <div class="form-floating ">
                      <input type="text" class="form-control " id="floatingInputGroup2" placeholder="Username" required>
                      <label for="floatingInputGroup2">Comfirmation</label>
                    </div>
                    <div class="invalid-feedback">
                      Please choose a username.
                    </div>
                  </div>
            </div>
            <div class="mx-auto my-3">
                <button class="btn btn-lg btn-success">s'inscrire</button>
            </div>

        </div>
    </div> --}}
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>
