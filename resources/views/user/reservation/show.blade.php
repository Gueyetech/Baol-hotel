<x-app-layout>
    @section('titre', 'Information de réservation')

    <div class="py-8">
    </div>

    <div class="bg-cover  text-white pt-16  object-fill" style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-4 text-center text-md md:text-2xl font-bold">
            INFORMATION DE
            <span class="text-[#baa538] text-uppercase">
                RESERVATION
            </span>
            <h1>
    </div>

    <div class="sm:mb-4 mt-4 max-w-6xl mx-auto px-3">
        <a href="{{ route('reservation') }}" class="inline-flex font-bold hover:shadow-sm text-[#352513]">
            <svg class="w-6 h-6 mr-2  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
            Retour
        </a>
    </div>


    <div class="bg-white max-w-5xl mt-5 mx-auto shadow-md p-4">

        <div class="whitespace-nowrap text-lg flex w-full">
            <p class="font-semibold mr-10">Référence:</p>
            <p class="font-bold">
                {{ $reservation->reference }}
            </p>
        </div>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 @if ($reservation->adulte != null) md:grid-cols-2 @endif md:gap-7">

            <div class="flex-col w-full">

                <div class="whitespace-nowrap justify-between text-lg flex w-full">
                    <p class="font-semibold mr-10">Date d'arrivée:</p>
                    <p class="font-bold">
                        {{ $reservation->date_arrivee() }}
                    </p>
                </div>

                <div class="whitespace-nowrap justify-between text-lg flex w-full">
                    <p class="font-semibold mr-10">Date de départ:</p>
                    <p class="font-bold">
                        {{ $reservation->date_depart() }}
                    </p>
                </div>
            </div>
            @if ($reservation->adulte != null)

                <div class="flex-col w-full">

                    <div class="whitespace-nowrap justify-between text-lg flex w-full">
                        <p class="font-semibold mr-10">Adultes:</p>
                        <p class="font-bold">
                            {{ $reservation->adulte }}
                        </p>
                    </div>

                    @if ($reservation->enfant != null)
                        <div class="whitespace-nowrap justify-between text-lg flex w-full">
                            <p class="font-semibold mr-10">Enfants:</p>
                            <p class="font-bold">
                                {{ $reservation->enfant }}
                            </p>
                        </div>
                    @endif

                    @if (($reservation->nombre != null) & ($reservation->enfant != null))
                        <div class="whitespace-nowrap justify-between text-lg flex w-full">
                            <p class="font-semibold mr-10">Nombre total:</p>
                            <p class="font-bold">
                                {{ $reservation->nombre }}
                            </p>
                        </div>
                    @endif
                </div>
            @endif

            <div class="flex-col w-full">

                <div class="whitespace-nowrap justify-between text-lg flex w-full">
                    <p class="font-semibold">Staus:</p>
                    <p class="font-bold">
                        {{ $reservation->status }}
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="bg-white max-w-5xl mt-5 mx-auto shadow-md p-4">

        <div class="whitespace-nowrap text-lg flex w-full">
            <p class="font-semibold mr-10">Facture(s)</p>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full mb-3">
                <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                    <tr>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">#</div>
                        </th>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">REFERENCE</div>
                        </th>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">DATE CREATION</div>
                        </th>
                        <th class="p-3 whitespace-nowrap">
                            <div class="font-semibold text-left">MONTANT(CFA)</div>
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
                                <div class="text-left">{{ number_format($facture->montant, '0', '.', ' ') }}</div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">{{ $facture->status }}</div>
                            </td>

                            <td class="p-3 whitespace-nowrap">
                                <div class="text-end flex gap-2 justify-end">
                                    @if ($facture->status != 'payé')
                                        <a href="{{ route('user.facture.show', $facture) }}">
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

                                        </form>
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
