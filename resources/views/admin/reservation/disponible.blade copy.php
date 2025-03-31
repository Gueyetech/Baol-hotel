<x-admin>



    @section('title', 'Selectionner votre '.$data['typeReservable'])


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
        <div class="mx-auto bg-white sm:rounded-sm p-4">
            <h1 class="text-1xl text-center font-bold ">@yield('title')</h1>
            <form
                action="{{ route('admin.reservation.showFormClient', ['data' => $data]) }}"
                method="POST" class="gap-5">
                @csrf
                @method('post')
                <div
                    class="flex flex-col justify-start items-start dark:bg-gray-800 bg- px-4 py-4 md:py-6 md:p-6 xl:p-8 ">

                    @forelse ($reservables as $reservable)
                        <div class="mt-4  flex flex-col sm:flex-row justify-start items-start sm:items-center sm:space-x-4 md:space-x-6 xl:space-x-8 w-full"
                            onclick="document.getElementById('{{ $reservable->id }}').checked=true;">
                            <input id="{{ $reservable->id }}" name="option" type="radio"
                                value="{{ $reservable->id }}" class="" />

                            <div class="pb-4 md:pb-8 w-full sm:w-64">
                                <img class="w-full " src="https://i.ibb.co/L039qbN/Rectangle-10.png" alt="dress" />
                            </div>
                            <div
                                class="border-b border-gray-200 sm:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                <div class="w-full flex flex-col justify-start items-start space-y-8">
                                    <h3
                                        class="text-xl dark:text-white xl:text-2xl font-semibold leading-6 text-gray-800">
                                        |{{ $reservable->numero }} </h3>



                                    <div class="flex justify-start items-start flex-col space-y-2">
                                        <p class="text-sm dark:text-white leading-none text-gray-800"><span
                                                class="dark:text-gray-400 text-gray-300">Capacité: </span>
                                                {{ $reservable->capacite }}
                                            </p>
                                        <p class="text-sm dark:text-white leading-none text-gray-800"><span
                                                class="dark:text-gray-400 text-gray-300">Catégorie: </span> {{ $reservable->categorie->nom }} </p>
                                        <p class="text-sm dark:text-white leading-none text-gray-800"><span
                                                class="dark:text-gray-400 text-gray-300">Color: </span> Light Blue</p>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-8 items-start w-full">
                                    <p
                                        class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800">
                                        {{  number_format($data['nombreDeJours'] * $reservable->tarif, 0, '.', ' ') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="mt-4 text-center w-full">
                            Aucune salle ou chambre disponible
                        </div>
                    @endforelse




                </div>


                <div class="gap-6 flex">

                    <a href="{{ route('admin.reservation.create') }}"
                    class="w-full text-center px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Retour
                    </a>
                    <button id="button" type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
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
