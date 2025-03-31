<x-app-layout>

    @section('titre', 'Mes réservations')

    <div class="py-8">
    </div>


    <div class="bg-cover  text-white pt-16  object-fill" style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-4 text-center text-md md:text-2xl font-bold">
            MES <span class="text-[#baa538] text-uppercase">
                RESERVATIONS </span>
            <h1>
    </div>

    <div class="w-full px-1">
        @forelse ($reservations as $reservation)
            <div class="bg-white max-w-2xl mt-5 p-4 mx-auto shadow-md ">
                <div class="whitespace-nowrap text-lg md:text-xl mb-3 font-bold w-full">
                    Réservation de
                    @if ($reservation->adulte != null)
                        chambre
                    @else
                        salle
                    @endif
                </div>
                <div class="grid md:gap-3 grid-cols-1 md:grid-cols-2">
                    <div class="">
                        <div class="whitespace-nowrap text-lg flex justify-between w-full">
                            <p class="">Date d'arrivée</p>
                            <p class="font-bold">{{ $reservation->date_arrivee() }}</p>
                        </div>
                        <div class="whitespace-nowrap text-lg flex justify-between w-full">
                            <p>Date départ</p>
                            <p class="font-bold">{{ $reservation->date_depart() }}</p>
                        </div>
                    </div>
                    <div class="">
                        <div class="whitespace-nowrap text-lg flex justify-between w-full">
                            <p>Montant total</p>
                            <p class="font-bold">
                                {{ number_format($reservation->getTotal(), 0, '.', ' ') }} CFA
                            </p>
                        </div>
                        <div class="whitespace-nowrap text-lg flex justify-between w-full">
                            <p>Status</p>
                            <p class="font-bold">{{ $reservation->status }}</p>
                        </div>
                    </div>
                </div>
                <div class="whitespace-nowrap text-right font-bold text-lg flex justify-end mt-2 w-full">
                    <a href="{{ route('reservation.show', $reservation) }}">
                        <p class="">Voir +</p>

                    </a>
                </div>
            </div>

        @empty
            <div class="bg-white max-w-2xl mt-5 mx-auto shadow-md p-4">
                <div class="whitespace-nowrap text-lg  text-center w-full">
                    <p class="">Vous avez aucune réservation</p>
                </div>
            </div>
        @endforelse
        @if ($reservations->count() < 4)
            <div class=" max-w-2xl mt-5 p-4 mx-auto shadow-md ">

                {{ $reservations->links() }}
            </div>
        @endif



    </div>








    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</x-app-layout>
