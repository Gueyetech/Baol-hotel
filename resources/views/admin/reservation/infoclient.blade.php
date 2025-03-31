<x-admin>

    @section('title', 'Information du client')

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

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');

        :root {
            --primary: #6b59d3;
            --secondary: #bfc0c0;
            --white: #fff;
            --text-clr: #5b6475;
            --header-clr: #25273d;
            --next-btn-hover: #8577d2;
            --back-btn-hover: #8b8c8c;
        }
    </style>
    {{-- @dd($reservation) --}}
    <div class=" h-full">
        <div class="mx-auto bg-white sm:rounded-sm p-4">
            <h1 class="text-1xl md:text-2xl mb-3 text-center font-bold ">@yield('title')</h1>
            <form action="{{ route('admin.reservation.createClient', ['data' => $data]) }}" method="POST" class="gap-5">
                @csrf
                @method('post')



                <div class="  grid gap-3 w-full sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-2 transition-all">
                    <div class="relative z-0 w-full mb-5">
                        <input required type="text" name="prenom" placeholder="" value="{{ old('prenom') }}"
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
                        <input required type="text" name="nom" placeholder="" value="{{ old('nom') }}"
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
                        <input required type="text" name="email" placeholder="" value="{{ old('email') }}"
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
                        <input required type="text" name="adresse" placeholder="" value="{{ old('adresse') }}"
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
                        <input required type="text" name="tel" placeholder="" value="{{ old('tel') }}"
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
                        <select name="genre"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                            <option   value="Fiminin">Fiminin</option>
                            <option   value="Masculin">Masculin</option>
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
                        <input required type="text" name="ville" placeholder="" value="{{ old('ville') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="ville" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Ville
                        </label>
                        @error('ville')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5">
                        <input required type="text" name="pays" placeholder="" value="{{ old('pays') }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        <label for="pays" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                            Pays
                        </label>
                        @error('pays')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>




                <div class="gap-6 flex">

                    <a href="{{ route('admin.reservation.create') }}"
                    class="w-full text-center px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Retour
                    </a>
                    <button id="button" type="submit"
                    class="w-full text-center px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Continuer
                    </button>
                </div>
            </form>
        </div>
    </div>



    <script>
        // Obtenez une référence à l'élément <select>
        const selectElement = document.querySelector('#choix');

        // Obtenez une référence aux éléments <div> contenant le contenu
        const contenu1 = document.querySelector('#c1');
        const contenu2 = document.querySelector('#c2');
        const contenu3 = document.querySelector('#c3');

        // Écoutez l'événement de changement de sélection
        selectElement.addEventListener('change', (event) => {
            const selectedOption = event.target.value;


            // Affichez le contenu correspondant en fonction de l'option sélectionnée
            if (selectedOption === 'chambre') {
                contenu1.style.display = 'block';
                contenu2.style.display = 'block';
                contenu3.style.display = 'none';
            } else if (selectedOption === 'salle') {
                contenu1.style.display = 'none';
                contenu2.style.display = 'none';
                contenu3.style.display = 'block';
            } else {
                // Si aucune option n'est sélectionnée, masquez les deux contenus
                contenu1.style.display = 'none';
                contenu2.style.display = 'none';
                contenu3.style.display = 'none';
            }
        });
    </script>

</x-admin>
