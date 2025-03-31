<x-admin>

    @section('title', $service->exists ? 'Modifier le service' : 'Ajouter un service')

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
    <div class=" h-full  ">
        <div class="mx-auto max-w-2xl shadow-xl px-6 py-6 bg-white border-0  sm:rounded-sm">
            <h1 class="text-1xl text-center font-bold mb-8">@yield('title')</h1>
            <form action="{{ route($service->exists ? 'admin.service.update' : 'admin.service.store', $service) }}"
                method="POST">
                @csrf
                @method($service->exists ? 'get' : 'post')
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">

                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="nom" placeholder=" " value="{{ old('nom', $service->nom) }}"
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
                    <div class="relative z-0 w-full mb-5">
                        <input type="number" name="prix" placeholder=" " value="{{ old('prix', $service->prix) }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="prix" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Prix
                        </label>
                        @error('prix')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="relative z-0 w-full mb-5">
                    <textarea name="description" placeholder=" "
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                    {{ old('description', $service->description) }}
                    </textarea>
                    <label for="description" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                        Description
                    </label>
                    @error('description')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button id="button" type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    @if ($service->exists)
                        Modifier
                    @else
                        Ajouter
                    @endif
                </button>


            </form>
        </div>
    </div>



</x-admin>
