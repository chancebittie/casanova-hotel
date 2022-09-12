<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Restaurant et Bar</h3>
                <div class="card-tools d-flex align-items-center ">
                    <!-- Button trigger modal -->
                    <button type="button" wire:click='goToAdd' class="btn btn-primary mr-4" >
                        <i class="fas fa-restaurantBar-plus"></i>    Nouveau
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
                            <th>N*</th>
                            <th>Nom</th>
                            <th>status</th>
                            <th>Credit</th>
                            <th>Offert</th>
                            <th>type</th>
                            <th>table</th>
                            <th>date</th>
                            <th>observation</th>
                            <th>Facture total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($restaurantBars)>0)
                        @foreach ($restaurantBars as $restaurantBar)
                            <tr>
                                <td>{{$restaurantBar->id}}</td>
                                @if (!empty($restaurantBar->client->nom) )
                                    <td>{{$restaurantBar->client->nom}} {{$restaurantBar->client->prenom}}</td>
                                @else
                                    <td>{{$restaurantBar->client_nom}}</td>
                                @endif
                                <td>{{$restaurantBar->status_paiement ? "payer" : "impayer"}}</td>
                                <td>{{$restaurantBar->offert ? "Oui" : "Non"}}</td>
                                <td>{{$restaurantBar->credit ? "Oui" : "Non"}}</td>
                                <td>{{$restaurantBar->type_dejeuner}}</td>
                                <td>{{$restaurantBar->numero_table}}</td>
                                <td>{{$restaurantBar->created_at->diffForHumans()}}</td>
                                <td>{{$restaurantBar->observation}},</td>
                                <td>{{$restaurantBar->montant_total}}</td>
                                <td class="text-center">
                                    <a href="{{route('downloadPdfRestau', $restaurantBar->id)}}" class="btn btn-primary"><i class="fas fa-eye">voir</i></a>
                                    {{-- <button class="btn btn-warning text-light" wire:click='goToEdit({{$restaurantBar->id}})'>Imprimer</button> --}}
                                    <button class="btn btn-success text-light" wire:click='comfirmer({{$restaurantBar->id}})' {{$restaurantBar->status_paiement ? "disabled" : " "}}>comfirmer</button>
                                </td>
                            </tr>
                         @endforeach
                        @else
                            <strong class="text-danger fs-1">Liste vide</strong>
                        @endif

                    </tbody>
                </table>
            </div>

        </div>

    </div>



    <!-- Modal -->
<div class="modal fade" wire:ignore.self id="modalRestaurant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticmodalRestaurant" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticmodalRestaurant">Restaurant et bar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form wire:submit.prevent='submit'>
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-4">
                        <label  class="form-label">Caissier</label>
                        <input type="text" disabled class="form-control " value=" {{ Auth::user()->name}} "  >
                    </div>

                    <div class="col-md-4">
                        <label for="input" class="form-label">Designation</label>
                        <select id="input"  wire:model='type_dejeuner' class="form-select @error('type_dejeuner') is-invalid @enderror">
                            <option> Petit déjeuner </option>
                            <option> Déjeuner </option>
                            <option> Diner </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputTFacture" class="form-label">Type de facture</label>
                        <select id="inputTFacture"   wire:model='type_facture' class="form-select">
                            <option>Bar</option>
                            <option>Restau</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="input1" class="form-label">type de client</label>
                        <select id="input1"   wire:model='type_client' class="form-select">
                            <option value="1">De l'hotel </option>
                            <option value="0"> De passage </option>
                        </select>
                    </div>

                    @if ($type_client==1)
                        <div class="col-md-4">
                            <label for="inputclient" class="form-label">Nom client</label>
                            <select id="inputclient"   wire:model='client_id' class="form-select @error('client_id') is-invalid @enderror">
                                @if ( count($clients) > 0)
                                    @foreach ($clients as $client)
                                        <option class="fs-5" value="{{ $client->id}}">    {{ $client->nom}} {{ $client->prenom}}
                                        </option>
                                    @endforeach
                                @else
                                    <option class="col-md-12 text-danger" >Pas de client </option>
                                @endif
                            </select>
                            @error('client_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    @endif

                    @if ($type_client==0)
                        <div class="col-md-4">
                            <label for="inputclient1" class="form-label">Nom client</label>
                            <input type="text" class="form-control @error('client_nom') is-invalid @enderror" id="inputclient1" wire:model='client_nom' autofocus >
                            @error('client_nom')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    @endif

                    <div class="col-md-4">
                        <label for="input20" class="form-label @error('numero_table') is-invalid @enderror">Numero de table</label>
                        <select id="input20"   wire:model='numero_table' class="form-select">
                            @for ($i = 1; $i <= 30; $i++)
                                <option > {{$i}} </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="input28" class="form-label @error('quantite') is-invalid @enderror">Quantite</label>
                        <select id="input28"   wire:model='quantite' class="form-select">
                            @for ($i = 1; $i <= 30; $i++)
                                <option > {{$i}} </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="input30" class="form-label">Prix unitaire</label>
                        <input type="text" wire:model='prix_unitaire' class="form-control @error('prix_unitaire') is-invalid @enderror" id="input30">
                          @error('prix_unitaire')
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                      </div>

                    <div class="col-md-4">
                      <label for="input30" class="form-label">comptant</label>
                      <input type="text" wire:model='comptant' class="form-control @error('comptant') is-invalid @enderror" id="input30">
                        @error('comptant')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="input25" class="form-label">Credit</label>
                        <select id="input25"   wire:model='credit' class="form-select @error('credit') is-invalid @enderror">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="input35" class="form-label @error('offert') is-invalid @enderror">Offert</label>
                        <select id="input35"   wire:model='offert' class="form-select">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </div>

                    {{-- <div class="col-md-4">
                        <label for="input7" class="form-label">Selectionner chambre</label>
                        <select id="input7"   wire:model='chambre_id' class="form-select">
                            @foreach ($chambre_libres as $chambre_libre)
                                <option value="{{$chambre_libre->id}}"> {{$chambre_libre->chambre_numero}} </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="col-md-4">
                        <label for="input8" class="form-label @error('nombre_couvert') is-invalid @enderror">Nombre de couvert</label>
                        <select id="input8"   wire:model='nombre_couvert' class="form-select">
                            @for ($i = 1; $i <= 30; $i++)
                                <option > {{$i}} </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="input23"  class="form-label">Montant total</label>
                        {{-- @if ($errors->all())
                            eee
                        @else --}}
                        <input type="text" wire:model='montant_total' disabled class="form-control @error('montant_total') is-invalid @enderror" id="input23" >

                        {{-- @endif --}}
                        {{-- <input type="text" wire:model='montant_total' disabled class="form-control @error('montant_total') is-invalid @enderror" id="input23" >
                        @error('montant_total')
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror --}}

                    </div>

                    <div class="col-md-4">
                        <label for="inputObservation" class="form-label">Observation</label>
                        <input type="text" wire:model='observation' class="form-control @error('observation') is-invalid @enderror" id="inputObservation">
                          @error('observation')
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      {{$paiement_facture_total}} H

                        {{-- @if (!empty($this->client_id)) --}}
                        {{-- {{ $client_id}} --}}
                        {{-- @else --}}
                        {{-- {{ $paiement_id}} --}}
                        {{-- @endif --}}
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

      </div>
    </div>
  </div>



</div>
