<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <table>
        <thead>
            <tr style="justify-content: space-between;font-weight: 800; padding: 0.5rem;">
                <th>
                    <h1 style="font-size: 1.5rem;font-style: italic;letter-spacing: 0.1em;color:black;">
                        BAOL HOTEL</h1>
                </th>
                <th class="p-2">
                    <div>
                        <span>
                            www.baolhotel.sn
                        </span>
                    </div>
                </th>
                <th>
                    <div>
                        <span>
                            Gawane, Mbacke, Diourbel, Sénégal
                        </span>
                    </div>
                    </ul>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 0.125rem; background-color:rgb(99, 102, 241)"></tr>
            <tr style="gap: 0.75rem padding: 1rem;   justify-content: space-between;">
                <th style="  text-align: left;padding-right:20px">
                    <div style="">
                        <p style="font-weight: 700;"> Réservation de
                            @if ($reservation->adulte != null)
                                Chambre
                            @else
                                Salle
                            @endif
                        </p>
                        <p style="font-weight: 600;">Date d'arrivée : <span>{{ $reservation->date_arrivee() }}</span></p>
                        <p style="font-weight: 600;">Date départ : <span>{{ $reservation->date_arrivee() }}</span></p>



                    </div>
                </th>

                <th style="margin-left:30px justify-content: space-between; text-align: left;width: 14rem;">
                    <div>
                        <p style="font-weight: 800;">Réserver par</p>
                        <p style="font-weight: 600;">Nom : <span>
                                {{ $client->user->prenom }} {{ $client->user->nom }}
                            </span>
                        </p>
                        <p style="font-weight: 600;">Email : <span>
                                {{ $client->user->email }}
                            </span>
                        </p>


                    </div>

                </th>
                <th style="margin-left:30px justify-content: space-between; text-align: left;width: 14rem;">
                    <div>
                        <p style="font-weight: 800;">Facture</p>
                        <p style="font-weight: 600;">Réference : <span class="text-sm font-medium">
                                {{ $facture->ref }}
                            </span>
                        </p>
                        <p style="font-weight: 600;">Date creation : <span class="text-sm font-medium">
                                {{ $facture->created_at() }}
                            </span>
                        </p>


                    </div>
                    </div>

            </tr>
        </tbody>
    </table>

    <table >
        <thead style="padding: 1rem;background-color:rgb(55, 65, 81);">
            <tr style=" justify-content: space-between; text-transform: uppercase; ">
                <th style=" justify-content: space-between; text-align: left;width: 2rem;">
                    <div style=" text-align: center;color:white;padding: ;font-weight: 800;">#</div>
                </th>
                <th style=" justify-content: space-between; text-align: left;width: 16rem;">
                    <div style="color:white;padding: 0.6rem;font-weight: 800;">DESIGNATION</div>
                </th>
                <th style=" justify-content: space-between; text-align: left;">
                    <div style="color:white;padding: 0.6rem;font-weight: 800;width: 7rem;">UNITE(XOF)</div>
                </th>
                <th style=" justify-content: space-between; text-align: left;">
                    <div style="color:white;padding: 0.6rem;font-weight: 800;">QUANTITE</div>
                </th>
                <th style=" justify-content: space-between; text-align: left;">
                    <div style="color:white;padding: 0.6rem;font-weight: 800;text-align: right;width: 9rem;">MONTANT
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="flex-1 gap-1 text-sm divide-y divide-gray-100">
            @php
                $i = 1;
                $montant = $reservation->reservable->tarif;
            @endphp
            @if ($facture->montant == $nombreDeJours * $montant + $totalMontantService)
                <tr
                    style="border-bottom-color:rgb(75, 85, 99) ;border-bottom-width: 2px; justify-content: space-between; text-transform: uppercase; ">
                    <th style=" justify-content: space-between; text-align: left;width: 2rem;">
                        <div style=" text-align: center;color:black;padding: ;font-weight: 800;">{{ $i++ }}
                        </div>
                    </th>
                    <th style=" justify-content: space-between; text-align: left;width: 16rem;">
                        <div style="padding: 0.6rem;font-weight: 800;">Jour(s)</div>
                    </th>
                    <th style=" justify-content: space-between; text-align: left;">
                        <div style="padding: 0.6rem;font-weight: 800;width: 7rem;">
                            {{ number_format($montant, 0, '.', ' ') }}</div>
                    </th>
                    <th style=" justify-content: space-between; text-align: left;">
                        <div style="padding: 0.6rem;font-weight: 800;">{{ $nombreDeJours }}</div>
                    </th>
                    <th style=" justify-content: space-between; text-align: left;">
                        <div style="padding: 0.6rem;font-weight: 800;text-align: right;width: 9rem;">
                            {{ number_format($nombreDeJours * $montant, 0, '.', ' ') }}
                        </div>
                    </th>

                </tr>
            @endif
            @if ($services->count() > 0)
                @foreach ($services as $service)
                    <tr
                        style="border-bottom-color:rgb(75, 85, 99) ;border-bottom-width: 2px; justify-content: space-between; text-transform: uppercase; ">
                        <th style=" justify-content: space-between; text-align: left;width: 2rem;">
                            <div style=" text-align: center;color:black;padding: ;font-weight: 800;">
                                {{ $i++ }}
                            </div>
                        </th>
                        <th style=" justify-content: space-between; text-align: left;width: 16rem;">
                            <div style="padding: 0.6rem;font-weight: 800;">
                                {{ $service->nom }}
                            </div>
                        </th>
                        <th style=" justify-content: space-between; text-align: left;">
                            <div style="padding: 0.6rem;font-weight: 800;width: 7rem;">
                                {{ number_format($service->prix, 0, '.', ' ') }}
                            </div>
                        </th>
                        <th style=" justify-content: space-between; text-align: left;">
                            <div style="padding: 0.6rem;font-weight: 800;">{{ $service->pivot->nbre }}</div>
                        </th>
                        <th style=" justify-content: space-between; text-align: left;">
                            <div style="padding: 0.6rem;font-weight: 800;text-align: right;width: 9rem;">
                                {{ number_format($service->prix * $service->pivot->nbre, 0, '.', ' ') }} CFA
                            </div>
                        </th>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th colspan="5">
                        <div style="padding: 1rem;text-align: center;" class=" text-center">
                            Aucune service
                        </div>
                    </th>
                </tr>
            @endif
        </tbody>
    </table>

    <table style="margin-top: 5rem;">
        <thead style="padding: 1rem;background-color:rgb(55, 65, 81);">
            <tr style=" justify-content: space-between; text-transform: uppercase; ">
                <th colspan="4" style=" justify-content: space-between; text-align: rigth;width: 32rem;">
                    <div style="text-align: right;color:white;padding: 0.6rem;font-weight: 800;">
                        MONTANT TOTAL
                    </div>
                </th>
                <th style=" justify-content: space-between; text-align: left;">
                    <div
                        style="text-align: right;color:white;padding: 0.6rem;font-weight: 800;text-align: right;width: 9.5rem;">
                        {{ number_format($facture->montant, 0, '.', ' ') }} CFA
                    </div>
                </th>
            </tr>
        </thead>
    </table>

    <table style="margin-top: 1rem;">
        <thead style="padding: 1rem;">
            <tr style=" justify-content: space-between; text-transform: uppercase; ">
                <th colspan="4" style=" justify-content: space-between; text-align: rigth;width: 32rem;"></th>
                <th style=" justify-content: space-between; text-align: left;">
                    <div style="text-align: right;padding: 0.6rem;font-weight: 800;text-align: right;width: 9.5rem;">
                        <h3>Signature</h3>
                        <div style="font-size: 1.5rem;font-style: italic;rgb(99, 102, 241)">Baol hotel</div>
                    </div>
                </th>
            </tr>
        </thead>
    </table>




</body>

</html>
