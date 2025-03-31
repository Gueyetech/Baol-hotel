<x-admin>



    @section('title', 'Selectionner votre ' . $data['typeReservable'])


    <div class=" h-full">
        <div class="mx-auto bg-white sm:rounded-sm p-2 md:p-4">
            <h1 class="text-xl mg:text-3xl lg:text-3xl text-center font-bold mb-5 ">@yield('title')</h1>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const reservableItems = document.querySelectorAll('.reservable-item');

                    reservableItems.forEach(item => {
                        item.addEventListener('click', function() {
                            const reservableId = this.getAttribute('data-reservable-id');
                            const radioInput = document.getElementById(reservableId);
                            if (radioInput) {
                                radioInput.checked = true;
                                updateSelectedReservable(this);
                            }
                        });
                    });

                    function updateSelectedReservable(clickedDiv) {
                        const clickedDivId = clickedDiv.id;
                        const allReservableItems = document.querySelectorAll('.reservable-item');

                        allReservableItems.forEach(item => {
                            item.classList.remove('border-4');
                        });

                        clickedDiv.classList.add('border-4');
                    }
                });
            </script>
            <form action="{{ route('admin.reservation.showFormClient', ['data' => $data]) }}" method="POST"
                class="">
                @csrf
                @method('post')
                <div class="flex   ">
                    <div class="w-full  justify-start items-start  ">

                        @forelse ($reservables as $reservable)
                            <div id="item-{{ $loop->index + 1 }}"
                                class="reservable-item  border-[#c9ba46] shadow-sm shadow-[#c9ba46] p-2 mt-4 block flex-col bg-white sm:flex-row justify-start items-start sm:items-center sm:p-2 md:p4 xl:p-6  w-full"
                                data-reservable-id="{{ $reservable->id }}">

                                <input id="{{ $reservable->id }}" name="option" type="radio"
                                    value="{{ $reservable->id }}" class="hidden"
                                    data-reservable-id="{{ $reservable->id }}" />

                                <div class="block w-full">
                                    <div class="w-full flex">
                                        <div
                                            class="sm:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                            <div class="w-full flex flex-col justify-start items-start space-y-8">
                                                <div class="block md:flex  w-full justify-between items-center">
                                                    <div class=" items-center">
                                                        <h3 class="text-2xl   xl:text-3xl font-bold leading-6 text-gray-800">
                                                            {{ $reservable->numero }}
                                                        </h3>
                                                    </div>
                                                    <div class="mt-4 md:mt-0 items-center">
                                                        <h3 class="text-2xl   xl:text-3xl font-bold leading-6 text-gray-800">
                                                            {{ number_format($data['nombreDeJours'] * $reservable->tarif, 0, '.', ' ') }}
                                                            CFA
                                                        </h3>
                                                    </div>
                                                </div>


                                                <div class="flex justify-start items-start flex-col space-y-2">
                                                    <p class="text-2xl mb-2 dark:text-white leading-none text-gray-800">
                                                        <span class="0 text-black">Capacité:
                                                        </span>
                                                        {{ $reservable->capacite }}
                                                    </p>
                                                    <p class="text-2xl leading-none text-black">
                                                        <span class="dark:text-gray-400">Catégorie:
                                                        </span> {{ $reservable->categorie->nom }}
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- <div class="flex justify-end space-x-8 items-start w-full">
                                                <p class="text-2xl text-black font-bold xl:text-lg leading-6 ">
                                                    {{ number_format($data['nombreDeJours'] * $reservable->tarif, 0, '.', ' ') }}
                                                    CFA
                                                </p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <div class="mt-4 text-center w-full">
                                Aucune salle ou chambre disponible
                            </div>
                        @endforelse
                    </div>



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
