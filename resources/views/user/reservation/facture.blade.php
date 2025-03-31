<x-app-layout>


    <div class="py-8">
    </div>

    @section('titre', 'Voir facture')

    @php
        $reservation = $facture->reservation;
        $services = $facture->services;
        $client = $reservation->client;
    @endphp

    <div class="sm:mb-4 mt-4 max-w-6xl mx-auto px-3">
        <a href="{{ route('reservation.show', $facture->reservation) }}"
            class="inline-flex font-bold hover:shadow-sm text-[#352513]">
            <svg class="w-6 h-6 mr-2  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
            Retour
        </a>
    </div>
    <div class="flex items-center justify-center overflow-x-auto  ">
        <div class="max-w-5xl p-2 bg-white shadow-lg">
            <div class="flex justify-between p-2">

                <div class="text-center  mb-3 p-2">
                    <a href="{{ route('acceuil') }}" class="text-2xl mx-auto text-black text-center font-bold">
                        BAOL <spam class="text-[#baa538]">HOTEL</spam>
                    </a>
                </div>
                <div class="p-2">
                    <ul class="flex">
                        <li class="flex flex-col items-center p-2 border-l-2 border-indigo-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <span class="text-sm">
                                www.baolhotel.sn
                            </span>

                        </li>
                        <li class="flex flex-col items-center p-2 border-l-2 border-indigo-200">
                            <svg class="w-6 h-6 mx-auto text-blue-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">
                                Gawane, Mbacke, Diourbel, Sénégal
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- @dd($reservation) --}}


            <div class="w-full h-0.5 bg-indigo-500"></div>
            <div class="flex justify-between p-4">
                <div>
                    <h6 class="font-bold">Detaille réservation<span class="text-sm font-medium">
                            @if ($reservation->adulte = !null)
                                chambre
                            @else
                                salle
                            @endif
                        </span></h6>
                    <h6 class="font-semibold">Date d'arrivée : <span
                            class="text-sm font-medium">{{ $reservation->date_arrivee() }}</span></h6>
                    <h6 class="font-semibold">Date départ : <span
                            class="text-sm font-medium">{{ $reservation->date_arrivee() }}</span></h6>

                    <h6 class="font-semibold">Personne(s) :
                        <span class="text-sm font-medium">
                            @if ($reservation->adulte = !null)
                                {{ $reservation->adulte }} adulte(s), {{ $reservation->enfant }} enfant(s)
                            @else
                                {{ $reservation->nombre }} place(s)
                            @endif
                        </span>
                    </h6>

                </div>



                <div class=" ml-2 w-56">
                    <div>
                        <h6 class="font-bold">Réserver par</h6>
                        <h6 class="font-semibold">Nom : <span class="text-sm font-medium">
                                {{ $client->user->prenom }} {{ $client->user->nom }}</span>
                        </h6>
                        <h6 class="font-semibold">Email : <span class="text-sm font-medium">
                                {{ $client->user->email }}</span></h6>
                        <h6 class="font-semibold">Adresse : <span class="text-sm font-medium">
                                {{ $client->user->adresse }}
                            </span></h6>

                    </div>

                </div>
                <div class="w-56">
                    <div>
                        <h6 class="font-bold">Facture</h6>
                        <h6 class="font-semibold">Réference : <span class="text-sm font-medium">{{ $facture->ref }}
                            </span>
                        </h6>
                        <h6 class="font-semibold">Date creation : <span class="text-sm font-medium">
                                {{ $facture->created_at() }}</span>
                        </h6>


                    </div>
                </div>

            </div>
            <div class=" w-full  p-4">
                <div class="border-b border-gray-200">
                    <table class="w-full mb-3">
                        <thead class="text-xs font-bold text-white uppercase  ">
                            <tr class="flex p-4 bg-gray-700 items-center justify-start">
                                <th class="w-5 mr-3">
                                    <div class=" font-bold text-white text-center">#</div>
                                </th>
                                <th class="w-40">
                                    <div class="font-bold text-white   text-left">DESIGNATION</div>
                                </th>
                                <th class="w-28">
                                    <div class="font-bold text-white   text-left">UNITE</div>
                                </th>
                                <th>
                                    <div class="font-bold text-white  text-left">QUANTITE</div>
                                </th>
                                <th class="ml-auto">
                                    <div class="font-bold text-white   text-right">MONTANT</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 gap-1 text-sm divide-y divide-gray-100">
                            @php
                                $i = 1;
                                $montant = $reservation->reservable->tarif;
                            @endphp
                            @if ($facture->montant == $nombreDeJours * $montant + $totalMontantService)
                                <tr class="flex justify-start p-4 border-b-2 border-b-gray-600">
                                    <th class="w-5 mr-3">
                                        <div class="font-semibold  text-center">{{ $i++ }} </div>
                                    </th>
                                    <th class="w-40">
                                        <div class="font-semibold  text-left ">
                                            jour(s)
                                        </div>
                                    </th>
                                    <th class="w-28">
                                        <div class="font-semibold  text-start">
                                            {{ number_format($montant, 0, '.', ' ') }}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="font-semibold  text-left ">
                                            {{ $nombreDeJours }}
                                        </div>
                                    </th>

                                    <th class="ml-auto">
                                        <div class="font-semibold   text-right">
                                            {{ number_format($nombreDeJours * $montant, 0, '.', ' ') }} CFA
                                        </div>
                                    </th>
                                </tr>
                            @endif

                            @if ($services->count() > 0)

                                @foreach ($services as $service)
                                    <tr class="flex justify-start p-4 border-b-2 border-b-gray-600">
                                        <th class="w-5 mr-3">
                                            <div class="font-semibold  text-center">{{ $i++ }} </div>
                                        </th>
                                        <th class="w-40">
                                            <div class="font-semibold  text-left ">
                                                {{ $service->nom }}
                                            </div>
                                        </th>
                                        <th class="w-28">
                                            <div class="font-semibold  text-start">
                                                {{ number_format($service->prix, 0, '.', ' ') }}
                                            </div>
                                        </th>
                                        <th>
                                            <div class="font-semibold  text-left ">
                                                {{ $service->pivot->nbre }}
                                            </div>
                                        </th>

                                        <th class="ml-auto">
                                            <div class="font-semibold   text-right">
                                                {{ number_format($service->pivot->nbre * $service->prix, 0, '.', ' ') }}
                                                CFA
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                                <div class="flex justify-between p-4 text-center">
                                    Aucune service
                                </div>
                            @endif

                            <tr class="mt-10 text-xs flex p-2 items-center bg-gray-700 justify-between">
                                <th class="ml-auto">
                                    <div class="font-bold text-white mr-10 ml-auto text-left">MONTANT TOTAL</div>
                                </th>
                                <th class="ml-10">
                                    <div class="font-bold w-36 text-lg text-white text-right">
                                        {{ number_format($facture->montant, 0, '.', ' ') }} CFA
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="flex justify-end p-4">

                <div class="text-center  mb-3 p-2">
                    <h3>Signature</h3>
                    <a href="{{ route('acceuil') }}" class="text-2xl text-black text-center font-bold">
                        BAOL <spam class="text-[#baa538]">HOTEL</spam>
                    </a>
                </div>
            </div>



        </div>
    </div>

</x-app-layout>
