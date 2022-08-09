<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Table d'en-tête fixe</h3>
                <div class="card-tools d-flex align-items-center ">
                    <!-- Button trigger modal -->
                    <button type="button" wire:click='goToAdd' class="btn btn-primary mr-4" >
                        <i class="fas fa-chambre-plus"></i>    Ajouter
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
                            {{-- <th>Identifiant</th> --}}
                            <th>Numero</th>
                            <th>status</th>
                            <th>Prix de chambre</th>
                            <th>Type de chambre</th>
                            <th>Bloc</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chambres as $chambre)
                            <tr>
                                {{-- <td>{{$chambre->id}}</td> --}}
                                <td>{{$chambre->numero}}</td>
                                <td>{{$chambre->status ? "Occupé" : "Disponible"}}</td>
                                <td>{{$chambre->type_chambre->chambre_prix}}</td>
                                <td>{{$chambre->type_chambre->chambre_type}}</td>
                                <td>{{$chambre->bloc}}</td>
                                <td class="text-center">
                                    <button class="btn btn-success"><i class="fas fa-eye">voir</i></button>
                                    <button class="btn btn-warning text-light" wire:click='goToEdit({{$chambre->type_chambre->id}},{{$chambre->id}})'><i class="fas fa-eye">Modifier</i></button>
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
                                      <input type="text" wire:model='numero' class="form-control  @error('numero') is-invalid @enderror"   autocomplete="numero" autofocus id="floatingInputGroup2" placeholder="Numero chambre" required>
                                      <label for="floatingInputGroup2">Numero chambre</label>
                                    </div>
                                  </div>
                                  @error('numero')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror

                            </div>

                            <div class="col-md mt-3">
                                <div class="form-floating">
                                  <select class="form-select fs-5" wire:model='type_chambre_id' id="floatingSelectGrid">
                                    @foreach ($typechambres as $typechambre)
                                        <option value="{{$typechambre->id}}"> {{$typechambre->chambre_type}} </option>
                                    @endforeach
                                  </select>
                                  <label for="floatingSelectGrid">Selectionner type de chambre</label>
                                </div>
                            </div>

                          <div class="col-md mt-3 border pt-3 bg-light rounded">
                            <p>Prix :
                                   @foreach ($type_chambres as $type_chambre)
                                        <strong>{{$type_chambre->chambre_prix}}</strong>
                                    @endforeach
                            </p>
                          </div>

                          <div class="col-md mt-3">
                            <div class="form-floating">
                              <select class="form-select fs-5" wire:model='bloc' id="floatingSelectGrid">
                                <option >Bloc A</option>
                                <option >Bloc B</option>
                                <option >Bloc C</option>
                              </select>
                              <label for="floatingSelectGrid">Selectionner bloc</label>
                            </div>
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
