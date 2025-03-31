<x-admin>

    @section('title', 'Detaille reservation')

    <div class="">
        <div class="bg-white  p-4 ">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-[#352513] ">
                    Détails de la Réservation de
                    @if ($reservation->adulte != null)
                        chambre
                    @else
                        salle
                    @endif
                </h2>

                <div class="flex  items-center">
                    <a class="font-bold p-2 rounded text-center px-3 py-2  text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none text-lg"
                        href="{{ route('admin.facture.createFacture', $reservation) }}">Ajouter facture</a>
                </div>
            </div>
            @include('components.toast')
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-2">
                <div><strong class='mr-2'>Référence:</strong> {{ $reservation->reference }} </div>
                <div><strong class='mr-2'>Date d'arrivée:</strong> {{ $reservation->date_arrivee() }} </div>
                <div><strong class='mr-2'>Date de départ:</strong>{{ $reservation->date_depart() }} </div>
                @if ($reservation->adulte != null)
                    <div><strong class='mr-2'>Adultes:</strong> {{ $reservation->adulte }} </div>
                    @if ($reservation->adulte != null)
                        <div><strong class='mr-2'>Enfants:</strong> {{ $reservation->enfant }} </div>
                        <div><strong class='mr-2'>Nombre total:</strong> {{ $reservation->nombre }} </div>
                    @endif
                @endif

                <div><strong class='mr-2'>Status:</strong>{{ $reservation->status }} </div>
            </div>

            @php
                $reservable = $reservation->reservable;
            @endphp

            <h3 class="text-xl font-bold mb-2">Informations du
                @if ($reservation->adulte != null)
                    chambre
                @else
                    salle
                @endif



            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-2">
                <div>
                    <strong class='mr-2'>Nom:</strong>
                    @if ($reservation->adulte != null)
                        <a href="{{ route('admin.chambre.edit', $reservable->chambre) }}">
                            {{ $reservable->numero }}
                        </a>
                    @else
                        <a href="{{ route('admin.salle.edit', $reservable->salle) }}">
                            {{ $reservable->numero }}
                        </a>
                    @endif
                </div>
                <div><strong class='mr-2'>Étage:</strong>{{ $reservable->etage }} </div>
                <div><strong class='mr-2'>Capacité:</strong> {{ $reservable->capacite }} </div>
                <div><strong class='mr-2'>Tarif:</strong> {{ $reservable->tarif }} </div>
            </div>

            @php
                $client = $reservation->client;
            @endphp

            <h3 class="text-xl font-bold mb-2">Informations du Client</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div><strong>Prénom:</strong> {{ $client->user->prenom }}</div>
                <div><strong>Nom:</strong> {{ $client->user->nom }}</div>
                <div><strong>Email:</strong> {{ $client->user->email }}</div>
                <div><strong>Téléphone:</strong>{{ $client->user->tel }}</div>
                <div><strong>Adresse:</strong> {{ $client->user->adresse }}</div>
                <div><strong>Genre:</strong> {{ $client->user->genre }}</div>
                <div><strong>Ville:</strong> {{ $client->ville }}</div>
                <div><strong>Pays:</strong> {{ $client->pays }}</div>
            </div>
        </div>

        <div class="overflow-x-auto mt-5 bg-white  p-4">
            <h2 class="text-2xl font-bold mb-3">Facture(s)</h2>
            <table class="table-auto w-full mb-3">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                        <th class="p-3 whitespace-nowrap text-center">
                            <div class="font-semibold text-left">#</div>
                        </th>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">REFERENCE</div>
                        </th>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">DATE CREATION</div>
                        </th>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">MONTANT(XOF)</div>
                        </th>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">STATUT</div>
                        </th>


                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-right">ACTIONS</div>
                        </th>
                        </tr>
                    </thead>
                <tbody class="min-w-md text-sm divide-y divide-gray-100">
                    @foreach ($reservation->factures as $facture)
                        <tr class="hover:bg-[#f9f9ed]">
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $loop->index + 1 }}</div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $facture->ref }}</div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $facture->created_at() }}</div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ number_format($facture->montant, '0', '.', ' ') }} </div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $facture->status }}</div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-end flex gap-2 justify-end">
                                    @if ($facture->status == 'non payé')
                                        <a href="{{ route('admin.facture.ajouterServiceForm', $facture) }}">

                                            <svg class="w-6 h-6 text-blue-500 hover:text-blue-900 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>

                                        </a>
                                    @endif
                                    @if ($facture->status != 'payé')
                                        <a href="{{ route('admin.facture.show', $facture) }}">
                                            <svg class="h-6 w-6 text-green-500 hover:text-green-900" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if ($facture->status == 'payé')
                                        <a href="{{ asset($facture->path) }}" target="_blank">
                                            <svg class="w-6 h-6  hover:text-gray-800 text-gray-500 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                                    d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.facture.formPayFacture', $facture) }}">
                                            <img class="h-6" src=" {{ asset('icons/money.png') }} ">
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach





                </tbody>
            </table>
        </div>
    </div>

</x-admin>
