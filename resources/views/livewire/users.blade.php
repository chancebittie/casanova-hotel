<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Table d'en-tête fixe</h3>
                <div class="card-tools d-flex align-items-center ">
                    <!-- Button trigger modal -->
                    <button type="button" wire:click='goToAdd' class="btn btn-primary mr-4" >
                        <i class="fas fa-user-plus"></i>    Ajouter
                    </button>
                    <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Chercher">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Pseudo</th>
                            <th>Roles</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->pseudo}}</td>
                                <td>{{$user->isAdmin ? "Administrateur":"Caissier"}}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-success"><i class="fas fa-eye">voir</i></button>
                                    <button class="btn btn-warning text-light" wire:click='goToEdit({{$user->id}})'><i class="fas fa-eye">Modifier</i></button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>


            <!-- Modal -->
            <div class="modal fade" wire:ignore.self id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> {{$editMode ? "modifier":"Ajouter"}} utilisateur </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='{{$editMode ? "modifier":"ajouter"}}'>

                    <div class="modal-body">

                            <div class="col-md mt-3  ">
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                                    <div class="form-floating ">
                                      <input type="text" wire:model='name' class="form-control  @error('name') is-invalid @enderror"   autocomplete="name" autofocus id="floatingInputGroup2" placeholder="Nom" required>
                                      <label for="floatingInputGroup2">Nom</label>
                                    </div>
                                  </div>
                                  @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                            </div>

                            <div class="col-md mt-3  ">
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fas fa-user-check"></i> </span>
                                    <div class="form-floating ">
                                      <input type="text" wire:model='pseudo' class="form-control @error('pseudo') is-invalid @enderror" autocomplete="pseudo" autofocus id="floatingInputGroup2" placeholder="Pseudo" required>
                                      <label for="floatingInputGroup2">Pseudo</label>
                                    </div>
                                  </div>
                                  @error('pseudo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                            </div>

                            {{-- <div class="row g-2"> --}}
                                <div class="col-md mt-3">
                                  <div class="form-floating">
                                    <select class="form-select fs-5" wire:model='role' id="floatingSelectGrid">
                                      <option value="1">Administrateur</option>
                                      <option value="0">Caissier</option>
                                    </select>
                                    <label for="floatingSelectGrid">selectionner Roles</label>
                                  </div>
                                </div>
                              {{-- </div> --}}


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn {{ $errors->all() ? 'btn-danger disabled': 'btn-primary'}}"> {{$editMode ? "Modifier":"Ajouter"}}</button>
                    </div>
                </form>
                </div>
                </div>
            </div>




</div>
