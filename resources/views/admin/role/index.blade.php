<x-admin>


    @section('title', 'Liste des roles')
    <div>
        <div class="mb-4 container d-flex justify-content-between align-items-center">
            <h5>@yield('title')</h5>
            <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Ajouter</a>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="text-xs font-semibold uppercase text-black bg-[#c9ba46]">
                                                       <tr class="hover:bg-[#f9f9ed]">

                            <td>#</td>  <td>NOM</td>
                            <td class="text-end">ACTIONS</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $role->role }}</td>

                                <td class="text-end">
                                    <div class="gap-2 d-flex justify-content-end align-items-center">
                                        <a href="{{ route('admin.role.edit', $role) }}"
                                            class="btn btn-primary">Modifier</a>
                                        <form action="{{ route('admin.role.destroy', $role) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-warning">
                                                 <svg class="h-5 w-5 text-red-400 hover:text-red-800" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>


</x-admin>
