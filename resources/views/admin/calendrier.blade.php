<x-admin>
    @section('title', 'Calendrier')





    {{-- Calendrier max-w-2xl --}}
    <div class=" max-w-2xl min-h-96 flex-col p-2 md:p-4 bg-white shadow-md hover:shadow-lg mx-auto overflow-hidden ">
        <div class="justify-between block md:flex">
            <h2 class="whitespace-nowrap font-bold text-2xl">Calendrier</h2>

            <form action="{{ route('admin.calendrier') }}" class="gap-2 flex">
                @csrf
                @method('get')
                <select name="reservable"
                    class="pt-3 pb-2 block w-full px-4 mt- bg-gray-50 border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                    <option @if ($reservable == 'all') selected @endif value="all">Chambre/Salle</option>
                    @foreach ($data['allChambres'] as $allChambre)
                        <option @if ($reservable == $allChambre->reservable->id) selected @endif
                            value="{{ $allChambre->reservable->id }}">{{ $allChambre->reservable->numero }}</option>
                    @endforeach
                    @foreach ($data['allSalles'] as $allSalle)
                        <option @if ($reservable == $allSalle->reservable->id) selected @endif
                            value="{{ $allSalle->reservable->id }}">{{ $allSalle->reservable->numero }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-[#c9ba46] hover:bg-[#a0852e] px-4 py-2 text-[#f9f9ed] font-bold">
                    Recherche
                </button>
            </form>

        </div>
        <div id='calendar' class="mt-6"></div>

        <script>
            $(document).ready(function() {
                var reservations = @json($data['statReservations']);

                var events = [];

                reservations.forEach(function(reservation) {
                    var bg = getRandomColor();

                    var event = {
                        title: reservation['reservable'],
                        start: reservation['date_arrivee'],
                        end: reservation['date_depart'],
                        backgroundColor: bg,
                        borderColor: bg,
                        reservationData: reservation
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
                    events: events,

                    eventClick: function(event) {
                        var reservation = event.reservationData;
                        var dateArrivee = moment(reservation.date_arrivee).locale('fr').format('LL');
                        var dateDepart = moment(reservation.date_depart).locale('fr').format('LL');

                        var details = `Nom du client: ${reservation.nom}<br>
                                        Date d'arrivée: ${dateArrivee}<br>
                                        Date de départ: ${dateDepart}<br>
                                        Réservation: ${reservation.reservable}`;

                        Swal.fire({
                            title: 'Détails de la réservation',
                            html: details,
                        });
                    }

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

    </div>

    {{-- Fin calendrier --}}















</x-admin>
