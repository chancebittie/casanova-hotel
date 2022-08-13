<div>
    <form wire:submit.prevent='reservation'>
        <div class="card-header bg-primary">
            <h3 class="card-title">Table d'en-tête fixe</h3>
            <div class="card-tools d-flex align-items-center ">
                <!-- Button trigger modal -->
                <button type="button" wire:click='goToAdd' class="btn btn-primary mr-4" >
                    <i class="fas fa-chambre-plus"></i>  Ajouter
                </button>
                <div class="input-group input-group-sm" x-data="{ open: false }" style="width: 150px;">
                <input type="text" name="table_search" wire:model="search"  x-on:click.away=" open = false " @click="open = true" class="form-control float-right" placeholder="Chercher">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    @if (strlen($search)>0)
                    {{-- <table x-show="open" class="table table-bordered text-dark  table-condensed" style="position: absolute;margin-top:50px;z-index:4;background:white;"> --}}
                {{-- <div class="col-md-12" > --}}
                    <select wire:model="client_id"  class="form-select fs-5" style="position: absolute;margin-top:50px;z-index:4;">
                    @if ( count($clients) > 0)
                            @foreach ($clients as $client)
                            {{-- <tr> <td > --}}
                                <option value="{{ $client->id}}">
                                    {{-- <button value="{{ $client->id}}" > --}}
                                    {{-- <img src="{{ Storage::url($user->avatar) }}" width="30" style="border-radius: 50%;"> &nbsp; --}}
                                        {{ $client->nom}} {{ $client->prenom}}
                                    {{-- </button> --}}
                                </option>
                                {{-- </td></tr> --}}

                            @endforeach
                    @else
                        <p class="col-md-12" style="position: absolute;margin-top:50px;z-index:4;color:red;background:rgb(246, 241, 241);">0 resultats pour "{{ $search }}"</p>
                    @endif

                {{-- </table> --}}
                {{-- </div> --}}
                </select>
            @endif
                </div>
            </div>
        </div>
        <div class="card-body ">
                <div class="row">
                <div class="col-md-4 mt-3">
                    <p class="form-control">Caissier : <strong>{{Auth::user()->name}}</strong></p>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="form-floating">
                        <select class="form-select fs-5" wire:model='mode_reservation' id="floatingSelectGrid">
                        {{-- @foreach ($typechambres as $typechambre) --}}
                            <option> personne </option>
                            <option> Société </option>
                        {{-- @endforeach --}}
                        </select>
                        <label for="floatingSelectGrid">mode de reservation</label>
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="form-floating">
                    <select class="form-select fs-5" wire:model='type_reservation' id="floatingSelectGrid">
                        {{-- @foreach ($typechambres as $typechambre) --}}
                            <option value="1"> occupé </option>
                            <option value="0"> reservation </option>
                        {{-- @endforeach --}}
                    </select>
                    <label for="floatingSelectGrid">type de reservation</label>
                    </div>
                </div>

                {{-- @if ($personneMode)
                <div class="col-md-4 mt-3">
                    <div class="form-floating">
                        <select class="form-select fs-5" wire:model='client_id' id="floatingSelectGrid">
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}"> {{$client->nom}} {{$client->prenom}} </option>
                        @endforeach
                        </select>
                        <label for="floatingSelectGrid">Selectionner client</label>
                    </div>
                </div>
                @endif --}}

                    <div class="col-md-4 mt-3  ">
                        <div class="input-group">
                            {{-- <span class="input-group-text"> <i class="fas fa-user"></i> </span> --}}
                            <div class="form-floating ">
                            <input type="text" wire:model='nom' class="form-control  @error('nom') is-invalid @enderror"  autofocus id="floatingInputGroup1" placeholder="Nom client" required>
                            <label for="floatingInputGroup1">Nom {{$personneMode ? "client" : "société"}}</label>
                            </div>
                        </div>
                        @error('nom')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                    </div>

                @if ($personneMode)
                    <div class="col-md-4 mt-3  ">
                    <div class="input-group">
                        {{-- <span class="input-group-text"> <i class="fas fa-user"></i> </span> --}}
                        <div class="form-floating ">
                            <input type="text" wire:model='prenom' class="form-control  @error('prenom') is-invalid @enderror"   autocomplete="prenom"  id="floatingInputGroup2" placeholder="Prenom client" required>
                            <label for="floatingInputGroup2">Prenom client </label>
                        </div>
                        </div>
                        @error('prenom')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                <div class="col-md-4 mt-3">
                    <div class="form-floating">
                    <select class="form-select fs-5" wire:model='nationalite' id="floatingSelectGrid1">
                        <option value="1">Ivoirien</option>
                        <option value="0">Etranger</option>
                    </select>
                    <label for="floatingSelectGrid1">Nationalité client</label>
                    </div>
                </div>

                @endif

                <div class="col-md-4 mt-3  ">
                    <div class="input-group">
                        <div class="form-floating ">
                            <input type="email" wire:model='email' class="form-control @error('email') is-invalid @enderror" autocomplete="email" id="floatingInputGroup3" placeholder="Email client" >
                            <label for="floatingInputGroup3">Email {{$personneMode ? "client" : "société"}}</label>
                        </div>
                        </div>
                        @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>


                    <div class="col-md-4 mt-3">
                        <div class="form-floating">
                        <select class="form-select fs-5" wire:model='type_chambre_id' id="floatingSelectGrid2">
                            @foreach ($typechambres as $typechambre)
                                <option value="{{$typechambre->id}}"> {{$typechambre->chambre_type}} </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectGrid2">Selectionner type de chambre</label>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                    <div class="form-floating">
                        <select class="form-select fs-5" wire:model='chambre_id' id="floatingSelectGrid3">
                        @foreach ($chambre_libres as $chambre_libre)
                            <option value="{{$chambre_libre->id}}"> {{$chambre_libre->chambre_numero}} </option>
                        @endforeach
                        </select>
                        <label for="floatingSelectGrid3">Selectionner chambre</label>
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="form-floating">
                        <select class="form-select fs-5" wire:model='nombre_chambre' id="floatingSelectGrid4">
                        @for ($i = 1; $i <= 30; $i++)
                        <option > {{$i}} </option>
                        @endfor
                        </select>
                        <label for="floatingSelectGrid4">Selectionner nombre de chambre</label>
                    </div>
                </div>

                <div class="col-md-4 mt-3  ">
                    <div class="input-group">
                        <div class="form-floating ">
                        <input type="date" wire:model='date_debut' class="form-control @error('date_debut') is-invalid @enderror" autocomplete="date_debut" id="floatingInputGroup4" min="{{ date('Y')  }}-{{ date('m')  }}-{{ date('d')  }}" required>
                        <label for="floatingInputGroup4">Date arrivé</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3  ">
                <div class="input-group">
                    <div class="form-floating ">
                        <input type="date" wire:model='date_fin' class="form-control @error('date_fin') is-invalid @enderror" autocomplete="date_fin" id="floatingInputGroup5"   min="{{ date('Y')  }}-{{ date('m')  }}-{{ date('d', strtotime('+1 day'))  }}"  required>
                        <label for="floatingInputGroup5">Date depart</label>
                    </div>
                    </div>
            </div>

            {{-- <div class="col-md-4 mt-3  ">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" wire:model='reduction' class="form-control @error('reduction') is-invalid @enderror" autocomplete="reduction" id="floatingInputGroup6" placeholder="Reduction" required>
                        <label for="floatingInputGroup6">Reduction</label>
                    </div>
                </div>
                    @error('reduction')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div> --}}

            <div class="col-md-4 mt-3 border pt-3 bg-light rounded">
                <p>Durée sejour : <strong> {{$duree_sejour}} </strong></p>
            </div>

            <div class="col-md-4 mt-3  ">
                <p class="form-control ">facture  : <strong>{{ $facture }}</strong></p>
            </div>



            </div>
            <div class="col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-success mx-auto" >Reserver</button>
            </div>


        </div>
    </form>
</div>
