<x-admin>
    @section('title', 'Accueil')


    {{-- Stats de chambre et de salle --}}

    <div
        class="w-full justify-center gap-3 md:gap-4 items-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 ">

        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <canvas id="statChambre"></canvas>
            <script>
                const statChambre = document.getElementById('statChambre');

                new Chart(statChambre, {
                    type: 'bar',
                    data: {
                        labels: @json($data['labels']),
                        datasets: [{
                            label: 'Nombre de chambre',
                            data: @json($data['statChambre']),
                            backgroundColor: '#c9ba46',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <canvas id="statSalle"></canvas>
            <script>
                const statSalle = document.getElementById('statSalle');
                new Chart(statSalle, {
                    type: 'bar',
                    data: {
                        labels: @json($data['labels']),
                        datasets: [{
                            label: 'Nombre de salle',
                            data: @json($data['statSalle']),
                            backgroundColor: '#c9ba46',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <canvas id="myPieChart"></canvas>
            <script>
                var ctx = document.getElementById('myPieChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['En cours', 'À venir', 'Arrivées', 'Parties'],
                        datasets: [{
                            label: 'Réservations',
                            data: [{{ $reservationsEnCours }}, {{ $reservationsAVenir }},
                                {{ $reservationsArrivees }}, {{ $reservationsParties }}
                            ],
                            backgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56',
                                '#4BC0C0'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            </script>
        </div>

        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <canvas class="w-full mx-auto" id="reservationsChart"></canvas>

            <script>
                var months = {!! json_encode($statReservations->pluck('month')) !!};
                var totals = {!! json_encode($statReservations->pluck('total')) !!};

                var ctx = document.getElementById('reservationsChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Nombre de réservations par mois',
                            data: totals,
                            backgroundColor: '#c9ba46',
                            borderColor: '#c9ba46',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }
                    }
                });
            </script>
        </div>


        {{-- Chambres --}}

        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Chambres</h2>
                <a href="{{ route('admin.chambre.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                        <tr>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">#</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">NUMERO</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">CAPACITE</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">TARIF</div>
                            </th>
                            <th class="p-3 sm:whitespace-wrap sm:whitespace-nowrap">
                                <div class="font-semibold text-left">CATEGORIE</div>
                            </th>
                            <th class="p-3 sm:whitespace-wrap sm:whitespace-nowrap">
                                <div class="font-semibold text-left">ETAT</div>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="max-w-md text-sm divide-y divide-gray-100">
                        @forelse ($data['chambres'] as $chambre)
                            <tr class="hover:bg-[#f9f9ed]">
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $loop->index + 1 }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $chambre->reservable->numero }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $chambre->reservable->capacite }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $chambre->reservable->tarif }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $chambre->reservable->categorie->nom }}</div>
                                </td>
                                <td class="p-3 whitespace-normal md:w-48">
                                    <div class="text-left">{{ $chambre->reservable->etat->etat }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="p-2 text-center">Aucune chambre</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Fin chambres et salles --}}

        {{--  salles --}}

        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Salles</h2>
                <a href="{{ route('admin.salle.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                        <tr>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">#</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">NUMERO</div>
                            </th>

                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">TARIF</div>
                            </th>
                            <th class="p-3 sm:whitespace-wrap sm:whitespace-nowrap">
                                <div class="font-semibold text-left">CATEGORIE</div>
                            </th>
                            <th class="p-3 sm:whitespace-wrap sm:whitespace-nowrap">
                                <div class="font-semibold text-left">ETAT</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="max-w-md text-sm divide-y divide-gray-100">
                        @forelse ($data['salles'] as $salle)
                            <tr class="hover:bg-[#f9f9ed]">
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $loop->index + 1 }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $salle->reservable->numero }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $salle->reservable->tarif }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $salle->reservable->categorie->nom }}</div>
                                </td>

                                <td class="p-3 whitespace-normal md:w-48">
                                    <div class="text-left">{{ $salle->reservable->etat->etat }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="p-3 text-center">Aucune salle</div>
                                </td>

                            </tr>
                        @endforelse



                    </tbody>
                </table>
            </div>
        </div>

        {{-- Fin salles --}}

        {{-- Réservations --}}

        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Réservations</h2>
                <a href="{{ route('admin.reservation.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                        <tr>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">#</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">REFERENCE</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">DATE ARRIVEE</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">DATE DEPART</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">NOM</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">STATUS</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="min-w-md text-sm divide-y divide-gray-100">
                        @forelse ($data['reservations'] as $reservation)
                            <tr class="hover:bg-[#f9f9ed]">
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $loop->index + 1 }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $reservation->reference }}</div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $reservation->date_arrivee() }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $reservation->date_depart() }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $reservation->client->user->prenom }}
                                        {{ $reservation->client->user->nom }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $reservation->status }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-3 whitespace-nowrap">
                                    <div class="text-center">Aucun reservation</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Réservations --}}


        {{-- client --}}

        <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Clients</h2>
                <a href="{{ route('admin.client.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                        <tr>

                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">#</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">NOM</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">EMAIL</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left"> PAYS</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="min-w-md text-sm divide-y divide-gray-100">
                        @forelse ($data['clients'] as $client)
                            <tr class="hover:bg-[#f9f9ed]">
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $loop->index + 1 }}</div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $client->user->prenom }} {{ $client->user->nom }}
                                    </div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $client->user->email }}</div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left"> {{ Str::limit($client->pays, 10) }}</div>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="p-2 text-center">Aucune chambre</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- fin client --}}

        @if (Auth::user()->role->role == 'admin')

            {{-- personnel --}}

            <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
                <div class="justify-between flex ">
                    <h2 class="whitespace-nowrap font-bold text-2xl">Personnels</h2>
                    <a href="{{ route('admin.personnel.index') }}"
                        class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
                </div>
                <div class="mt-3 overflow-x-auto">
                    <table class="table-auto w-full mb-3">
                        <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                            <tr>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">#</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">NOM</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">EMAIL</div>
                                </th>

                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">SERVICE</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="min-w-md text-sm divide-y divide-gray-100">
                            @forelse ($data['personnels'] as $personnel)
                                <tr class="hover:bg-[#f9f9ed]">

                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $loop->index + 1 }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $personnel->user->prenom }}
                                            {{ $personnel->user->nom }}
                                        </div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $personnel->user->email }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $personnel->service }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="p-3 text-center">Aucun personnel</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- fin personnel --}}

            {{-- service --}}
            <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
                <div class="justify-between flex items-center">
                    <h2 class="whitespace-nowrap font-bold text-2xl">Services</h2>
                    <a href="{{ route('admin.service.index') }}"
                        class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
                </div>
                <div class="mt-3 overflow-x-auto">
                    <table class="table-auto w-full mb-3">
                        <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                            <tr>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">#</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">NOM</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">PRIX</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($data['services'] as $service)
                                <tr class="hover:bg-[#f9f9ed]">
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $loop->index + 1 }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $service->nom }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $service->prix }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="p-3 whitespace-nowrap">
                                        <div class="text-center">Aucun service</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- fin service --}}

            {{-- Categories --}}

            <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
                <div class="justify-between flex items-center">
                    <h2 class="whitespace-nowrap font-bold text-2xl">Categories</h2>
                    <a href="{{ route('admin.categorie.index') }}"
                        class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
                </div>
                <div class="mt-3 overflow-x-auto">
                    <table class="table-auto w-full mb-3">
                        <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                            <tr>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">#</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">NOM</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="min-w-md text-sm divide-y divide-gray-100">
                            @forelse ($data['categories'] as $categorie)
                                <tr class="hover:bg-[#f9f9ed]">
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $loop->index + 1 }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $categorie->nom }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="p-2 whitespace-nowrap">
                                        <div class="text-center">Aucun service</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- fin Categories --}}

            {{-- Debut equipement --}}

            <div class="flex-col p-4 h-full bg-white shadow-md hover:shadow-lg">
                <div class="justify-between flex items-center">
                    <h2 class="whitespace-nowrap font-bold text-2xl">Equippements</h2>
                    <a href="{{ route('admin.equippement.index') }}"
                        class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
                </div>
                <div class="mt-3 overflow-x-auto">
                    <table class="table-auto w-full mb-3">
                        <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                            <tr>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">#</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">NOM</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">REFERENCE</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">CHAMBRE/SALLE</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="min-w-md text-sm divide-y divide-gray-100">
                            @forelse ($data['equippements'] as $equippement)
                                <tr class="hover:bg-[#f9f9ed]">
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $loop->index + 1 }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $equippement->nom }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $equippement->ref }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $equippement->reservable->numero }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="p-2 whitespace-nowrap">
                                        <div class="text-center">Aucun equipement</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Fin equipement --}}

        @endif

    </div>


</x-admin>
