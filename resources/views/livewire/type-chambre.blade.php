<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Table d'en-tête fixe</h3>
                <div class="card-tools d-flex align-items-center ">
                    <!-- Button trigger modal -->
                    <button type="button" wire:click='goToAdd' class="btn btn-primary mr-4" >
                        <i class="fas fa-typechambre-plus"></i>    Ajouter
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
                            <th>chambre_type</th>
                            <th>chambre_prix</th>
                            {{-- <th>Roles</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($typechambres as $typechambre)
                            <tr>
                                <td>{{$typechambre->id}}</td>
                                <td>{{$typechambre->chambre_type}}</td>
                                <td>{{$typechambre->chambre_prix}}</td>
                                {{-- <td>{{$typechambre->isAdmin ? "Administrateur":"Caissier"}}</span></td> --}}
                                <td class="text-center">
                                    <button class="btn btn-success"><i class="fas fa-eye">voir</i></button>
                                    <button class="btn btn-warning text-light" wire:click='goToEdit({{$typechambre->id}})'><i class="fas fa-eye">Modifier</i></button>
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
                                    <span class="input-group-text"> <i class="fas fa-typechambre"></i> </span>
                                    <div class="form-floating ">
                                      <input type="text" wire:model='chambre_type' class="form-control  @error('chambre_type') is-invalid @enderror"   autocomplete="chambre_type" autofocus id="floatingInputGroup2" placeholder="Type de chambre" required>
                                      <label for="floatingInputGroup2">Type de chambre</label>
                                    </div>
                                  </div>
                                  @error('chambre_type')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                            </div>

                            <div class="col-md mt-3  ">
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fas fa-typechambre-check"></i> </span>
                                    <div class="form-floating ">
                                      <input type="text" wire:model='chambre_prix' class="form-control @error('chambre_prix') is-invalid @enderror" autocomplete="chambre_prix" id="floatingInputGroup2" placeholder="Prix de chambre" required>
                                      <label for="floatingInputGroup2">Prix de chambre</label>
                                    </div>
                                  </div>
                                  @error('chambre_prix')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary"> {{$editMode ? "Modifier":"Ajouter"}}</button>
                    </div>
                </form>
                </div>
                </div>
            </div>




</div>
