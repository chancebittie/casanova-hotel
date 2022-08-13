<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="col-md-12 mt-3  mx-auto">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                                <div class="form-floating ">
                                  <input type="text" wire:model='name' class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus id="floatingInputGroup2" placeholder="Nom" required>
                                  <label for="floatingInputGroup2">Nom</label>
                                </div>
                              </div>
                              @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                        </div>

                        <div class="col-md-12 mt-3  mx-auto">
                            <div class="input-group">
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
                                  <input type="password" wire:model='password' class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  autocomplete="email"  id="floatingInputGroup3" placeholder="password" required>
                                  <label for="floatingInputGroup3">Mots de passe</label>
                                </div>
                            </div>
                              @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                        </div>

                        <div class="col-md-12 mt-3  mx-auto">
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fas fa-eye-slash"></i> </span>
                                <div class="form-floating ">
                                  <input type="password" wire:model='password_confirmation' class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="password_confirmation"  id="floatingInputGroup4" required>
                                  <label for="floatingInputGroup2">Comfirmation</label>
                                </div>
                            </div>
                         @error('password_confirmation')
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>


                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn {{ $errors->all() ? 'btn-danger disabled': 'btn-primary'}}">
                                    {{ __("s'inscrire") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
