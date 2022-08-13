<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card mt-5">
                <div class="card-header "><strong>{{ config('app.name', 'Laravel') }}</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="col-md-12 mt-3  mx-auto">
                            <div class="input-group ">
                                <span class="input-group-text"> <i class="fas fa-user-check"></i> </span>
                                <div class="form-floating ">
                                  <input type="text" wire:model='pseudo' class="form-control @error('pseudo') is-invalid @enderror" name="pseudo" value="{{ old('pseudo') }}"  autocomplete="pseudo" autofocus id="floatingInputGroup2" placeholder="Pseudo" required>
                                  <label for="floatingInputGroup2">Pseudo</label>
                                </div>
                              </div>
                              @error('pseudo')
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-3  mx-auto">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fas fa-eye"></i> </span>
                                <div class="form-floating ">
                                  <input type="password" wire:model='password' class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  autocomplete="password"  id="floatingInputGroup3" placeholder="password" required>
                                  <label for="floatingInputGroup3">Mots de passe</label>
                                </div>
                              </div>
                             @error('password')
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Se souvenir de moi') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn {{ $errors->all() ? 'btn-danger disabled': 'btn-primary'}}">
                                    {{ __('Connexion') }}
                                </button>
                                <a href="/inscription">inscription</a>
                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
