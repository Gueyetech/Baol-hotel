<x-admin>

    @section('title', $role->exists ? 'Modifier le role' : 'Ajouter un role')

    <div class="container">
        <div class="mb-4 container text-center align-items-center">
            <h5>@yield('title')</h5>
        </div>
        <form action="{{ route($role->exists ? 'admin.role.update' : 'admin.role.store', $role) }}"
            method="POST">
            @csrf
            @method($role->exists ? 'get' : 'post')

            <div class="g-3 row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <label for="role" class="form-label">Nom</label>
                    <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role',$role->role) }}">
                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mt-2 col-lg-8 col-md-8 col-sm-8">
                    <button type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        @if ($role->exists)
                            Modifier
                        @else
                            Ajouter
                        @endif
                    </button>
                </div>
            </div>
        </form>
    </div>






</x-admin>
