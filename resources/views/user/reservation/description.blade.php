<x-app-layout>
    @section('title', 'Detaille reservation')

    <div class="py-8">
    </div>
    <div class="bg-cover bg-center text-white pt-10  object-fill"
        style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-2 pl-4 text-lg">INFORMATION  DE RESERVATION<h1>
    </div>



    <div class="bg-white mx-auto p-4">
        <div class="bg-white  mt-4 ">


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-2">
                <div><strong>Référence:</strong> {{ $reservation->reference }} </div>
                <div><strong>Date d'arrivée:</strong> {{ $reservation->date_arrivee }} </div>
                <div><strong>Date de départ:</strong>{{ $reservation->date_depart }} </div>
                <div><strong>Adultes:</strong> {{ $reservation->adulte }} </div>
                <div><strong>Enfants:</strong> {{ $reservation->enfant }} </div>
                <div><strong>Nombre total:</strong> {{ $reservation->nombre }} </div>
                <div><strong>Status:</strong> {{ $reservation->status }} </div>
            </div>

            @php
                $reservable = $reservation->reservable;
            @endphp

            <h3 class="text-xl font-bold mb-2">Informations du Réservable</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-2">
                <div><strong>Numéro:</strong> {{ $reservable->numero }} </div>
                <div><strong>Étage:</strong>{{ $reservable->etage }} </div>
                <div><strong>Capacité:</strong> {{ $reservable->capacite }} </div>
                <div><strong>Tarif:</strong> {{ $reservable->tarif }} </div>
                <div><strong>Description:</strong> Une belle chambre avec vue sur la mer.</div>
            </div>
        </div>

        <div class="overflow-x-auto mt-5">
            <h2 class="text-2xl font-bold mb-3">Facture(s)</h2>
            <table class="table-auto w-full mb-3">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">REFERENCE</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">DATE CREATION</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">MONTANT</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">STATUT</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-right">ACTIONS</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="min-w-md text-sm divide-y divide-gray-100">
                    @foreach ($reservation->factures as $facture)
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $facture->ref }}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $facture->created_at }}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $facture->montant }}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $facture->status }}</div>
                            </td>

                            <td class="p-2 whitespace-nowrap">
                                <div class="text-end flex gap-2 justify-end">
                                    <a href="{{ route('user.facture.show', $facture) }}">
                                        <svg class="h-6 w-6 text-green-500" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </a>
                                    @if ($facture->status == 'payé')
                                        <a href="{{ route('admin.facture.pdf', $facture) }}">
                                            <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="7 10 12 15 17 10" />
                                                <line x1="12" y1="15" x2="12" y2="3" />
                                            </svg>
                                        </a>
                                    @else
                                        {{-- <a href="{{ route('admin.facture.formPayFacture', $facture) }}"> --}}
                                        <a href="">
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





</x-app-layout>
