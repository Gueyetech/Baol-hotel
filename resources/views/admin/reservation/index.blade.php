<x-admin>

    @section('title', 'Liste des réservations')

    <div class="justify-center   h-full">
        <div class=" w-full mx-auto bg-white">
            <header class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                <h5 class="font-bold text-lg">@yield('title')</h5>
                <a href="{{ route('admin.reservation.create') }}"
                    class="text-sm bg-[#c9ba46]  px-4 py-2 text-black font-bold">Ajouter</a>
            </header>
            <div class="p-2 flex gap-2 justify-between">

                <form action="{{ route('admin.reservation.recherche') }}" method="POST"
                    class="flex shadow-sm mt-1 gap-3 max-w-lg">
                    @csrf
                    @method('post')
                    <div class="w-full">
                        <input type="text" name="recherche" value="{{ old('recherche', $recherche) }}"
                            class="pt-3 pb-2 block w-full px-4 mt-0 bg-gray-100 border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        @error('recherche')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="bg-[#c9ba46] hover:bg-[#a0852e] px-4 py-2 text-[#f9f9ed] font-bold">
                        Recherche
                    </button>
                </form>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-white border-2 border-[#c9ba46] focus:ring-0 focus:outline-none font-medium rounded-lg text-sm p-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    <svg class="w-6 h-6 text-[#c9ba46] dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M5.05 3C3.291 3 2.352 5.024 3.51 6.317l5.422 6.059v4.874c0 .472.227.917.613 1.2l3.069 2.25c1.01.742 2.454.036 2.454-1.2v-7.124l5.422-6.059C21.647 5.024 20.708 3 18.95 3H5.05Z" />
                    </svg>

                </button>

                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('admin.reservation.filtre', ['filtre' => 'En cours']) }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">En
                                cours</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reservation.filtre', ['filtre' => 'Arrivée']) }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Arrivées</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reservation.filtre', ['filtre' => 'Départ']) }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Départs</a>
                        </li>
                         <li>
                            <a href="{{ route('admin.reservation.filtre', ['filtre' => 'Passés']) }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Passés</a>
                        </li>

                    </ul>
                </div>
            </div>


            <div class="p-2">
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
                                    <div class="font-semibold text-left">DATE ARRIVEE</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">DATE DEPART</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">PRENOM ET NOM</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">STATUS</div>
                                </th>

                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-right">ACTIONS</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="min-w-md text-sm divide-y divide-gray-100">
                            @forelse ($reservations as $reservation)
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
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-end flex gap-2 justify-end">
                                            <a href="{{ route('admin.reservation.show', $reservation) }}">
                                                <svg class="w-6 h-6 text-blue-400 hover:text-blue-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="2"
                                                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                    <path stroke="currentColor" stroke-width="2"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>

                                            </a>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-2 whitespace-nowrap">
                                        <div class="text-center">Aucune reservation</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $reservations->links() }}
            </div>
        </div>
    </div>






</x-admin>
