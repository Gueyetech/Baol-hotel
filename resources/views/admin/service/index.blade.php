<x-admin>

    @section('title', 'Liste des services')





    <div class="justify-center   h-full">
        <div class=" w-full mx-auto bg-white">
            <header class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                <h5>@yield('title')</h5>
                <a href="{{ route('admin.service.create') }}" class="text-sm bg-[#c9ba46]  px-4 py-2 text-black font-bold">Ajouter</a>
            </header>
            @include('components.toast')
            <div class="p-2">
                <form action="{{ route('admin.service.recherche') }}" method="POST"
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
                    </div>
                    <button type="submit" class="bg-[#c9ba46] hover:bg-[#a0852e] px-4 py-2 text-[#f9f9ed] font-bold">
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
                                    <div class="font-semibold text-left">NOM</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">PRIX(FCFA)</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">DESCRIPTION</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-right">ACTIONS</div>
                                </th>

                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">

                            @forelse ($services as $service)
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
                                    <td class="p-3 whitespace-nowrap md:w-52">
                                        <div class="text-left">{{ Str::limit($service->description,80) }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap ">
                                        <div class="text-end flex gap-2 justify-end">
                                            <a href="{{ route('admin.service.edit', $service) }}"
                                                class="btn btn-primary">
                                                <svg class="w-6 h-6 text-blue-400 hover:text-blue-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.service.destroy', $service) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn ">
                                                    <svg class="h-5 w-5 text-red-400 hover:text-red-800" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>

                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-center">Aucun service</div>
                                    </td>

                                </tr>
                            @endforelse



                        </tbody>
                    </table>
                </div>
                {{ $services->links() }}
            </div>
        </div>
    </div>






</x-admin>
