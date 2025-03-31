<x-admin>

    @section('title', 'Ajouter un salle')

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

    <div class=" h-full">
        <div class="mx-auto max-w-3xl shadow-xl px-6 py-6 bg-white border-0  sm:rounded-sm">
            <h1 class="text-1xl text-center font-bold mb-8">@yield('title')</h1>
            <form action="{{ route('admin.salle.store', $salle) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="relative z-0 w-full mb-5 text-center justify-center">
                    <div class=" mx-auto  max-w-64 gap-4 items-center w-fit ">
                        <img src="https://placehold.co/200x200" alt="Image de profil" class=" h-52  profile-image">
                        <label for="Image" class="mt-6 inline-block cursor-pointer">
                            <span class="inline-block px-4 py-2 rounded-md bg-gray-800 text-white hover:bg-gray-700">
                                Ajouter l'image
                            </span>
                            <input type="file" id="Image"  name="image" class="hidden">
                        </label>
                         @error('image')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">

                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="numero" placeholder="" value="{{ old('numero') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="numero" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Numero</label>
                        @error('numero')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <input type="number" name="etage" placeholder=" " value="{{ old('etage') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="etage"
                            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Etage</label>
                        @error('etage')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="capacite" placeholder="" value="{{ old('capacite') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="capacite" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Capacite</label>
                        @error('capacite')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="tarif" placeholder="" value="{{ old('tarif') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="numero" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Tarif</label>
                        @error('tarif')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <select name="categorie"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                        <label for="categorie"
                            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Categorie</label>
                        @error('categorie')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="relative z-0 w-full mb-5">
                    <textarea type="text" name="description" placeholder=" "
                        class="pt-3 pl-0 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                            {{ old('description') }}
                        </textarea>
                    <label for="description" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                        Description</label>
                    @error('description')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button id="button" type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    Ajouter
                </button>
            </form>
        </div>
    </div>









</x-admin>
