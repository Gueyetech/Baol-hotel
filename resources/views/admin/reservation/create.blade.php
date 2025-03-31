<x-admin>

    @section('title', 'Ajouter une reservation')

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

    <div class=" h-full">
        <form action="{{ route('admin.reservation.store') }}" method="POST"
            class="gap-5 p-4  bg-white   sm:rounded-sm max-w-lg mx-auto">
            @csrf
            @method('post')

            <h2 class="text-2xl mb-5 font-semibold  text-[#352513]">Detaille reservation</h2>

            <div class="  grid gap-3 w-full sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-2 transition-all">
                <div class="relative z-0 w-full mb-5">
                    <input type="date" name="date_arrivee" placeholder=" " value="{{ old('date_arrivee', date('Y-m-d')) }}"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="date_arrivee" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                        Date arrivée
                    </label>
                    @error('date_arrivee')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5">
                    <input type="date" name="date_depart" placeholder=" " value="{{ old('date_depart') }}"
                     min="{{ date('Y-m-d') }}"   class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="date_depart" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                        Date départ
                    </label>
                    @error('date_depart')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-5">
                    <select id="choix" name="typeReservable"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                        <option value="chambre">Chambre</option>
                        <option value="salle">Salle </option>
                    </select>
                    <label for="typeReservable" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Type
                        reservable</label>
                    @error('typeReservable')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div id="c1" class="relative z-0 w-full mb-5">
                    <select name="adulte"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                        <option selected value="1">1 </option>
                        <option value="2">2 </option>
                        <option value="3">3 </option>
                        <option value="4">4 </option>
                    </select>
                    <label for="adulte" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Adulte</label>
                    @error('adulte')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div id="c2" class="relative z-0 w-full mb-5">
                    <select name="enfant"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                        <option selected value="0">0 </option>
                        <option value="1">1 </option>
                        <option value="2">2 </option>
                        <option value="3">3 </option>
                        <option value="5">5 </option>
                        <option value="6">6 </option>
                    </select>
                    <label for="enfant" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enfant</label>
                    @error('enfant')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="gap-6 flex">

                <a href="{{ route('admin.reservation.index') }}"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    Retour
                </a>
                <button id="button" type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    Recherche
                </button>
            </div>
        </form>
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
