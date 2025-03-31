<x-admin>

    @section('title', $categorie->exists ? 'Modifier le categorie' : 'Ajouter un categorie')

    <style>
        .-z-1 {
            z-index: -1;
        }

        .origin-0 {
            transform-origin: 0%;
        }

        input:focus~label,
        input:not(:placeholder-shown)~label,
        textarea:focus~label,
        textarea:not(:placeholder-shown)~label,
        select:focus~label,
        select:not([value='']):valid~label {
            /* @apply transform; scale-75; -translate-y-6; */
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            --tw-scale-x: 0.75;
            --tw-scale-y: 0.75;
            --tw-translate-y: -1.5rem;
        }

        input:focus~label,
        select:focus~label {
            --tw-text-opacity: 1;
            color: rgba(0, 0, 0, var(--tw-text-opacity));
            left: 0px;
        }
    </style>

    <div class=" h-full p-6 ">
        <div class="mx-auto max-w-md shadow-xl px-6 py-5 bg-white border-0  sm:rounded-sm">
            <h1 class="text-1xl text-center font-bold mb-8">@yield('title')</h1>
            <form
                action="{{ route($categorie->exists ? 'admin.categorie.update' : 'admin.categorie.store', $categorie) }}"
                method="POST">
                @csrf
                @method($categorie->exists ? 'get' : 'post')

                <div class="relative z-0 w-full mb-5">
                    <input type="text" name="nom" placeholder=" " value="{{ old('nom', $categorie->nom) }}"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="nom" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                        Nom
                    </label>
                    @error('nom')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button id="button" type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    @if ($categorie->exists)
                        Modifier
                    @else
                        Ajouter
                    @endif
                </button>
            </form>
        </div>
    </div>

</x-admin>
