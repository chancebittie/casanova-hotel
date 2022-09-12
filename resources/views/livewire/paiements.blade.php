<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Table d'en-tête fixe</h3>
                <div class="card-tools d-flex align-items-center ">
                    <!-- Button trigger modal -->
                    <button type="button" wire:click='goToAdd' class="btn btn-primary mr-4" >
                        <i class="fas fa-paiement-plus"></i>    Ajouter
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
                            <th>Chambre</th>
                            <th>Facture total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paiements as $paiement)
                            <tr>
                                <td>{{$paiement->id}}</td>
                                <td>{{$paiement->client->nom}} {{$paiement->client->prenom}}</td>
                                <td>{{$paiement->status_paiement ? "payer" : "impayer"}}</td>
                                {{-- <td>{{$paiement->chambre_status ? "Occupé" : "Disponible"}}</td> --}}
                                <td>{{$paiement->chambre->chambre_numero}}</td>
                                <td>{{$paiement->facture_total}}</td>
                                {{-- <td>{{$paiement->bloc}}</td> --}}
                                <td class="text-center">
                                    <a href=" {{route('downloadPDF', $paiement->id)}} " class="btn btn-success" ><i class="fas fa-eye">voir</i></a>
                                    {{-- <button class="btn btn-warning text-light" wire:click='goToEdit({{$paiement->type_chambre->id}})'>Imprimer</button> --}}
                                    <button class="btn btn-warning text-light" wire:click='goToEdit({{$paiement->type_chambre->id}})'>comfirmer</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>



</div>
