<x-admin>

    @section('title', 'Liste des clients')


    <div class="justify-center   h-full">
        <div class=" w-full mx-auto bg-white">
            <header class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                <h5>@yield('title')</h5>
                <a href="{{ route('admin.client.create') }}"
                    class="text-sm bg-[#c9ba46]  px-4 py-2 text-black font-bold">Ajouter</a>
            </header>
            @include('components.toast')
            <div class="p-2">
                <form action="{{ route('admin.client.recherche') }}" method="POST"
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
                                    <div class="font-semibold text-left">IMAGE</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">PRENOM & NOM</div>
                                </th>

                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">EMAIL</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">ADRESSE</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">TELEPHONE</div>
                                </th>
                                <th class="p-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">VILLE & PAYS</div>
                                </th>


                                <th class="p-3 whitespace-nowrap ">
                                    <div class="font-semibold  text-right">ACTIONS</div>
                                </th>

                            </tr>
                        </thead>
                        <tbody class="min-w-md text-sm divide-y divide-gray-100">
                            @forelse ($clients as $client)
                                <tr class="hover:bg-[#f9f9ed]">
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ $loop->index + 1 }}
                                        </div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left w-14">
                                            <img class="" src="{{ asset($client->user->image) }}">
                                        </div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $client->user->prenom }} {{ $client->user->nom }}
                                        </div>
                                    </td>

                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $client->user->email }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap md:w-48">
                                        <div class="text-left">{{ Str::limit($client->user->adresse, 10) }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $client->user->tel }}</div>
                                    </td>
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-left">{{ $client->ville }}, {{ $client->pays }}</div>
                                    </td>

                                    <td class="p-3 whitespace-nowrap">
                                        <div class="text-end justify-end flex gap-2 ">
                                            <a href="{{ route('admin.client.edit', $client) }}"
                                                class="btn btn-primary">
                                                <svg class="w-6 h-6 text-blue-400 hover:text-blue-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>
                                            </a>

                                            @if (Auth::user()->role->role == 'admin')
                                                <form id="deleteForm{{$loop->index + 1}}"
                                                    action="{{ route('admin.client.destroy', $client) }}"
                                                    class="gap-2" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" id="deleteButton" class="focus:outline-none">
                                                        @if ($client->active == 'inactive')
                                                            <svg class="w-6 h-6 text-red-500 hover:text-red-800"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" fill="none"
                                                                viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-6 h-6 text-green-500 hover:text-green-800"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" fill="none"
                                                                viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10 14v3m4-6V7a3 3 0 1 1 6 0v4M5 11h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z" />
                                                            </svg>
                                                        @endif
                                                    </button>
                                                </form>
                                                @php
                                                    if ($client->active == 'inactive') {
                                                        $active = 'activer';
                                                    } if ($client->active == 'active') {
                                                        $active = 'désactiver';
                                                    }
                                                @endphp
                                                <script>
                                                    document.getElementById('deleteForm').addEventListener('click', function(e) {
                                                        e.preventDefault();
                                                        Swal.fire({
                                                            title: 'Êtes-vous sûr de vouloir {{ $active }} ce client ?',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#fffff',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Oui, {{ $active }}',
                                                            cancelButtonText: 'Annuler'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                this.submit();
                                                            }
                                                        });
                                                    });
                                                </script>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="p-3 text-center">Aucune chambre</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $clients->links() }}
            </div>
        </div>
    </div>





</x-admin>
