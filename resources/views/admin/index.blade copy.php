<x-admin>
    @section('title', 'Accueil')


    {{-- Stats de chambre et de salle --}}

    <div
        class="w-full justify-center gap-3 md:gap-6 items-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 ">
        <div class="flex-col p-4 bg-white shadow-md hover:shadow-lg">
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
        <div class="flex-col p-4 bg-white shadow-md hover:shadow-lg">
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
    </div>
    
    {{-- Fin stats de chambre et de salle --}}

    {{-- Stat reservation  --}}

    {{-- <div class="flex-col p-4  shadow-md hover:shadow-lg">
        <canvas id="statReservation"></canvas>
        <script>
            const statReservation = document.getElementById('statReservation');
            var months = [];
            var data = [];
            var statReservations= @json($data['statReservations'])
            statReservations.forEach(function(statReservation) {
                months.push(statReservation.year + '-' + statReservation.month);
                data.push(statReservation.total);
            });
            new Chart(statReservation, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Nombre de réservations par mois',
                        data : data,
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
    </div> --}}

    {{-- Fin stat reservation --}}


    {{-- Calendrier --}}
    <div class="mt-6 max-w-xl bg-white mx-auto overflow-hidden ">
        <div class="justify-between flex ">
            <h2 class="whitespace-nowrap font-bold text-2xl">Calendrier</h2>
        </div>
        <div id='calendar' class=""></div>
    </div>
    <script>
        $(document).ready(function() {
            var reservations = @json($data['reservations']);

            var events = [];

            reservations.forEach(function(reservation) {
                var bg = getRandomColor();

                var event = {
                    title: reservation.reference,
                    start: reservation.date_arrivee, // Exemple: utilise la date de création
                    end: reservation.date_depart, // Exemple: utilise la date de départ
                    backgroundColor: bg,
                    borderColor: bg,
                };

                events.push(event);
            });

            $('#calendar').fullCalendar({
                editable: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: events
            });
        });

        // Fonction pour obtenir une couleur aléatoire
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

    {{-- Fin calendrier --}}



    {{-- Chambres et salles --}}
    <div
        class="w-full mt-4 justify-center gap-3 md:gap-6 items-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 ">
        <div class="flex-col p-2 md:p-4 bg-white shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Chambres</h2>
                <a href="{{ route('admin.chambre.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-gray-300">
                        <tr>
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
                            <tr>
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
        <div class="flex-col p-2 md:p-4 bg-white shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Salles</h2>
                <a href="{{ route('admin.salle.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-gray-300">
                        <tr>
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
                            <tr>

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

    </div>
    {{-- Fin chambres et salles --}}


    {{-- Réservations --}}

    <div class="p-2 md:p-4 gap-4 bg-white shadow-md hover:shadow-lg">
        <div class="justify-between flex ">
            <h2 class="whitespace-nowrap font-bold text-2xl">Réservations</h2>
            <a href="{{ route('admin.reservation.index') }}"
                class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
        </div>
        <div class="mt-3 overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="text-xs font-semibold uppercase text-black bg-gray-300">
                    <tr>
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
                        <tr>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $reservation->reference }}</div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $reservation->date_arrivee }}</div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $reservation->date_depart }}</div>
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


    <div class="w-full justify-between mt-4  sm:flex md:flex-wrap lg:flex-wrap xl:flex-wrap block  items-start ">

        {{-- client --}}

        <div
            class="w-full bg-white  sm:w-[48%] md::w-[48%] lg:w-[48%] xl:w-[48%] p-2 md:p-4  shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Clients</h2>
                <a href="{{ route('admin.client.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-gray-300">
                        <tr>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">NOM</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">EMAIL</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">TELEPHONE</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left"> PAYS</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="min-w-md text-sm divide-y divide-gray-100">
                        @forelse ($data['clients'] as $client)
                            <tr>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $client->user->prenom }} {{ $client->user->nom }}
                                    </div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $client->user->email }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $client->user->tel }}</div>
                                </td>
                                <td class="p-3 whitespace">
                                    <div class="text-left"> {{ $client->pays }}</div>
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

        {{-- personnel --}}

        <div
            class="w-full bg-white sm:mt-3 sm:w-[48%] md::w-[48%] lg:w-[48%] xl:w-[48%] p-2 md:p-4  shadow-md hover:shadow-lg">
            <div class="justify-between flex ">
                <h2 class="whitespace-nowrap font-bold text-2xl">Personnels</h2>
                <a href="{{ route('admin.personnel.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-gray-300">
                        <tr>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">NOM</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">EMAIL</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">TELEPHONE</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">SERVICE</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="min-w-md text-sm divide-y divide-gray-100">
                        @forelse ($data['personnels'] as $personnel)
                            <tr>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $personnel->user->prenom }} {{ $personnel->user->nom }}
                                    </div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $personnel->user->email }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $personnel->user->tel }}</div>
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
        <div
            class="w-full bg-white sm:mt-3 sm:w-[48%] md::w-[48%] lg:w-[48%] xl:w-[48%] p-2 md:p-4  shadow-md hover:shadow-lg">
            <div class="justify-between flex items-center">
                <h2 class="whitespace-nowrap font-bold text-2xl">Services</h2>
                <a href="{{ route('admin.service.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-gray-300">
                        <tr>
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
                            <tr>
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

        <div
            class="w-full bg-white sm:mt-3 sm:w-[48%] md::w-[48%] lg:w-[48%] xl:w-[48%] p-2 md:p-4  shadow-md hover:shadow-lg">
            <div class="justify-between flex items-center">
                <h2 class="whitespace-nowrap font-bold text-2xl">Categories</h2>
                <a href="{{ route('admin.categorie.index') }}"
                    class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">NOM</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="min-w-md text-sm divide-y divide-gray-100">
                        @forelse ($data['categories'] as $categorie)
                            <tr>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $categorie->nom }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-center">Aucun service</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- fin Categories --}}

        {{-- Factures --}}

        <div
            class="w-full bg-white sm:mt-3 sm:w-[48%] md::w-[48%] lg:w-[48%] xl:w-[48%] p-2 md:p-4  shadow-md hover:shadow-lg">
            <div class="justify-between flex items-center">
                <h2 class="whitespace-nowrap font-bold text-2xl">Factures</h2>
                <a href="" class="whitespace-nowrap font-semibold hover:font-bold text-gray-600 text-xl">Voir
                    +</a>
            </div>
            <div class="mt-3 overflow-x-auto">
                <table class="table-auto w-full mb-3">
                    <thead class="text-xs font-semibold uppercase text-black bg-gray-300">
                        <tr>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">REFERENCE</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">MONTANT</div>
                            </th>
                            <th class="p-3 whitespace-nowrap">
                                <div class="font-semibold text-left">STATUS</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse ($data['factures'] as $facture)
                            <tr>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $facture->ref }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $facture->montant }}</div>
                                </td>
                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left">{{ $facture->status }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-3 whitespace-nowrap">
                                    <div class="text-center">Aucun facture</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- fin Factures --}}






    </div>













</x-admin>
