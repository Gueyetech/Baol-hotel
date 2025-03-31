<x-admin>


    @section('title', 'Liste des chambres')

    <div class="justify-center   h-full">
        <div class=" w-full mx-auto bg-white">
            <header class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                <h5>@yield('title')</h5>
                @if (Auth::user()->role->role == 'admin')
                    <a href="{{ route('admin.chambre.create') }}" class="text-sm bg-[#c9ba46]  px-4 py-2 text-black font-bold">Ajouter</a>
                @endif
            </header>
            @include('components.toast')
            <div class="p-2">
                <form action="{{ route('admin.chambre.recherche') }}" method="POST"
                    class="flex shadow-sm mt-1 gap-3 max-w-lg">
                    @csrf
                    @method('post')
                    <div class="w-full">
                        <input type="text" name="recherche" value="{{ old('recherche') }}"
                            class="pt-3 pb-2 block w-full px-4 mt-0 bg-gray-100 border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        @error('recherche')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div> <button type="submit"
                        class="bg-[#c9ba46] hover:bg-[#a0852e] px-4 py-2 text-[#f9f9ed] font-bold">
                        Recherche
                    </button>
                </form>
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
                                    <div class="font-semibold text-left">PHOTO</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">NUMERO</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">ETAGE</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">CAPACITE</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">TARIF(CFA)</div>
                                </th>
                                <th class="p-3 sm:whitespace-wrap sm:whitespace-nowrap">
                                    <div class="font-semibold text-left">CATEGORIE</div>
                                </th>
                                <th class="p-3 sm:whitespace-wrap sm:whitespace-nowrap">
                                    <div class="font-semibold text-left">ETAT</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-right">ACTION</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="max-w-md text-sm divide-y divide-gray-100">
                            @forelse ($chambres as $chambre)
                                <tr class="hover:bg-[#f9f9ed]">

                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $loop->index + 1 }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left h-14 w-16">
                                            <img class="w-full h-full" src="{{ asset($chambre->reservable->image) }}">
                                        </div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $chambre->reservable->numero }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $chambre->reservable->etage }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $chambre->reservable->capacite }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ number_format($chambre->reservable->tarif,'0','.',' ') }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $chambre->reservable->categorie->nom }}</div>
                                    </td>

                                    <td class="p-3 whitespace-normal md:w-48">
                                        <div class="text-left">{{ $chambre->reservable->etat->etat }}</div>
                                    </td>

                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-end flex gap-2 justify-end">
                                            <a href="{{ route('admin.chambre.edit', $chambre) }}"
                                                class="btn btn-primary">
                                                <svg class="w-6 h-6 text-blue-400 hover:text-blue-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>
                                            </a>
                                            {{-- @if (Auth::user()->role->role == 'admin')
                                                <form action="{{ route('admin.chambre.destroy', $chambre) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn ">
                                                        <svg class="h-6 w-6 text-red-700" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg> </button>
                                                </form>
                                            @endif --}}


                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <div class="p-2 text-center">Aucune chambre</div>
                                    </td>

                                </tr>
                            @endforelse



                        </tbody>
                    </table>
                </div>
                {{ $chambres->links() }}
            </div>
        </div>
    </div>



</x-admin>
