<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Table d'en-tête fixe</h3>
                <div class="card-tools d-flex align-items-center ">
                    <!-- Button trigger modal -->
                    <a href="reservations" type="button"  class="btn btn-primary mr-4" >
                        <i class="fas fa-reservation-plus"></i>    Reservation
                    </a>
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
                            <th>Nom</th>
                            {{-- <th>status</th> --}}
                            <th>facture</th>
                            <th>Arrivé</th>
                            <th>Depart</th>
                            <th>Sejours</th>
                            <th>Chambre</th>
                            <th>Nombre</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td >{{$reservation->client->nom}} {{$reservation->client->prenom}}</td>
                                {{-- <td><button class='btn {{$reservation->status_reservation ? " " : "btn-primary"}}' >{{$reservation->status_reservation ? "payé" : "impayé  "}}</button> </td> --}}
                                <td>{{number_format($reservation->facture, 0, ',', '.')}}</td>
                                {{-- <td>{{$reservation->chambre_status ? "Occupé" : "Disponible"}}</td> --}}
                                <td>{{strftime("%d %B %Y", strtotime($reservation->date_debut))}}</td>
                                <td>{{strftime("%d %B %Y", strtotime($reservation->date_fin))}}</td>
                                {{-- <td>{{$reservation->date_fin->translatedFormat('%d %B %Y') }}</td> --}}
                                <td class="text-center">{{$reservation->duree_sejour}}</td>
                                <td class="text-center">{{$reservation->chambre->chambre_numero}}</td>
                                <td class="text-center">{{$reservation->nombre_chambre}} </td>
                                <td >
                                    <button class="btn btn-success {{$reservation->type_reservation ? "disabled" : ""}}" wire:click='goToConfirm({{$reservation->id}})'>Comfirmer</i></button>
                                    <button class="btn btn-primary" wire:click='goToEdit({{$reservation->id}})'>modifier</button>
                                    <button class="btn btn-danger {{$reservation->type_reservation ? "disabled" : ""}}" wire:click='goToDelete({{$reservation->id}})' >Annuler</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>

    {{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button> --}}

    <!-- Modal -->
<div class="modal fade" wire:ignore.self id="modalReservation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3">

                <div class="col-md-4">
                    <label  class="form-label">Caissier</label>
                    <input type="text" disabled class="form-control" wire:model='caissier' >
                </div>

                <div class="col-md-4">
                    <label for="input" class="form-label">mode de reservation</label>
                    <select id="input"  wire:model='mode_reservation' class="form-select">
                        <option> personne </option>
                        <option> Société </option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="input1" class="form-label">type de reservation</label>
                    <select id="input1"   wire:model='type_reservation' class="form-select">
                        <option value="1"> occupé </option>
                        <option value="0"> reservation </option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="input2" class="form-label">Nom client</label>
                    <input type="text" class="form-control" id="input2" wire:model='nom'>
                        @error('nom')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="col-md-6">
                    <label for="input3" class="form-label">Prenom client</label>
                    <input type="text" class="form-control" id="input3" wire:model='prenom'>
                        @error('prenom')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="col-md-4">
                  <label for="inputEmail" class="form-label">Email</label>
                  <input type="email" wire:model='email' class="form-control" id="inputEmail">
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="input5" class="form-label">type de reservation</label>
                    <select id="input5"   wire:model='nationalite' class="form-select">
                        <option value="1">Ivoirien</option>
                        <option value="0">Etranger</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="input6" class="form-label">Type de chambre</label>
                    <select id="input6"   wire:model='type_chambre_id' class="form-select">
                        @foreach ($typechambres as $typechambre)
                            <option value="{{$typechambre->id}}"> {{$typechambre->chambre_type}} </option>
                         @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="input7" class="form-label">Selectionner chambre</label>
                    <select id="input7"   wire:model='chambre_id' class="form-select">
                        @foreach ($chambre_libres as $chambre_libre)
                            <option value="{{$chambre_libre->id}}"> {{$chambre_libre->chambre_numero}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="input8" class="form-label">Nombre de chambre</label>
                    <select id="input8"   wire:model='nombre_chambre' class="form-select">
                        @for ($i = 1; $i <= 30; $i++)
                            <option > {{$i}} </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4">
                  <label for="inputDate1" class="form-label">Date arrivé</label>
                  <input type="date" wire:model='date_debut' class="form-control @error('date_debut') is-invalid @enderror" autocomplete="date_debut" id="floatingInputGroup4" min="{{ date('Y')  }}-{{ date('m')  }}-{{ date('d')  }}" required>
                </div>

                <div class="col-md-4">
                  <label for="inputDate2" class="form-label">Date depart</label>
                  <input type="date" wire:model='date_fin' class="form-control @error('date_fin') is-invalid @enderror" autocomplete="date_fin" id="floatingInputGroup5"   min="{{ date('Y')  }}-{{ date('m')  }}-{{ date('d', strtotime('+1 day'))  }}"  required>
                </div>

                <div class="col-md-4">
                    <label  class="form-label">Durée sejour </label>
                    <input type="text" disabled wire:model='duree_sejour' class="form-control"  >
                </div>

                <div class="col-md-4">
                    <label  class="form-label">facture</label>
                    <input type="text" wire:model='facture'  class="form-control" id="inputEmail4" >
                </div>

              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>


</div>
