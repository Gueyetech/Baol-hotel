<x-admin>

    @section('title', 'Ajouter un personnel')


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
            <form action="{{ route('admin.personnel.store', $personnel) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="relative z-0 w-full mb-5 text-center justify-center">
                    <div class=" mx-auto  max-w-64 gap-4 items-center w-fit ">
                        <img src="{{asset('bh/user.jpeg')}}" alt="Image de profil" class=" h-52  profile-image">
                        <label for="Image" class="mt-6 inline-block cursor-pointer">
                            <span class="inline-block px-4 py-2 rounded-md bg-gray-800 text-white hover:bg-gray-700">
                                Ajouter l'image
                            </span>
                            <input type="file" id="Image" name="image" class="hidden">
                        </label>
                        @error('image')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="prenom" placeholder="" value="{{ old('prenom') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="prenom" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Prenom</label>
                        @error('prenom')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="nom" placeholder="" value="{{ old('nom') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="nom" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            nom</label>
                        @error('nom')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="email" placeholder="" value="{{ old('email') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Email</label>
                        @error('email')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                            <div class="relative z-0 w-full mb-5">
                        <select name="genre"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">

                            <option @if ($client->user->genre == 'Fiminin') selected @endif value="Fiminin">Fiminin</option>
                            <option @if ($client->user->genre == 'Masculin') selected @endif value="Masculin">Masculin</option>
                        </select>
                        <label for="genre"
                            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Genre</label>
                        @error('genre')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                     <div class="relative z-0 w-full mb-5">
                        <input type="text" name="adresse" placeholder="" value="{{ old('adresse') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="adresse" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Adresse</label>
                        @error('adresse')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="tel" placeholder="" value="{{ old('tel') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="tel" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Telephone</label>
                        @error('tel')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <select name="role"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->role }}
                                </option>
                            @endforeach


                        </select>
                        <label for="role"
                            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Role</label>
                        @error('role')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="service" placeholder="" value="{{ old('service') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="service" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Service
                        </label>
                        @error('service')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>







                <button id="button" type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    Ajouter
                </button>
            </form>
        </div>
    </div>


</x-admin>
