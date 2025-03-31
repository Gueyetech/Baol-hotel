<x-app-layout>

    @section('titre', 'Sélectionner votre ' . $data['typeReservable'] . '')

    <div class="py-8">
    </div>

    <div class="bg-cover bg-center text-white pt-10  object-fill"
        style="background-image: url({{ asset('image/gallery.jpg') }}">
    </div>

    <div class="sm:mb-4 mt-4 ml-3">
        <a href="{{ route('reservation.retour', ['url' => 'acceuil']) }}" class="inline-flex text-[#352513]">
            <svg class="w-6 h-6 mr-2  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
            retour
        </a>
    </div>

    <div class=" h-full block md:flex">
        <div class="sm:w-full md:w-2/3">
            <h1 class="text-2xl ml-4 md:ml-10 text-start font-bold ">@yield('titre')</h1>
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
            <form action="{{ route('reservation.create', ['data' => $data]) }}" method="post" class="gap-5">
                @csrf
                @method('post')
                <div class="flex flex-col  justify-start items-start  px-4 py-4 md:py-6 md:p-6 xl:p-8 ">

                    @forelse ($reservables as $reservable)
                        <div id="item-{{ $loop->index + 1 }}"
                            class="reservable-item  border-[#c9ba46]  mt-4 block flex-col bg-white sm:flex-row justify-start items-start sm:items-center sm:p-2 md:p4 xl:p-6  w-full"
                            data-reservable-id="{{ $reservable->id }}">

                            <input id="{{ $reservable->id }}" name="option" type="radio"
                                value="{{ $reservable->id }}" class="hidden"
                                data-reservable-id="{{ $reservable->id }}" />


                            <div class=" block sm:flex md:flex ">
                                <div class="w-full sm:w-1/2 md:w-1/2 ">
                                    <img class="w-full h-full" src="{{ asset($reservable->image) }}"
                                        alt="dress" />
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/2 block justify-between   items-start ">
                                    <div class=" flex justify-between  items-start p-4 lg:p-6">
                                        <h3
                                            class="text-xl dark:text-white xl:text-2xl font-semibold leading-6 text-gray-800">
                                            |{{ $reservable->numero }}
                                        </h3>
                                        <h3
                                            class="whitespace-nowrap  text-xl font-bold text-[#806328] dark:text-white xl:text-lg  leading-6 ">
                                            {{ number_format($reservable->tarif * $data['nombreDeJours'], '0', '.', ' ') }} CFA
                                        </h3>
                                    </div>
                                    <div class="w-full justify-start space-y-4 items-start p-4 lg:p-6">
                                        <h3 class="text-lg dark:text-white ">
                                            <span class="dark:text-gray-400 text-gray-300 mr-11">
                                                Capacité:
                                            </span>
                                            {{ $reservable->capacite }}
                                        </h3>
                                        <h3 class="text-lg dark:text-white leading-none text-gray-800">
                                            <span class="dark:text-gray-400 text-gray-300 mr-10">
                                                Catégorie:
                                            </span>
                                            {{ $reservable->categorie->nom }}
                                        </h3>

                                    </div>
                                </div>

                            </div>
                            <div class="p-3 justify-start  items-start w-full">

                                <p class="text-base dark:text-white  xl:text-lg font-semibold leading-6 text-gray-800">
                                    {{  Str::limit($reservable->description, 150) }}</p>
                            </div>

                        </div>
                    @empty

                        <div class="mt-4 text-center w-full">
                            @if ($data['typeReservable'] == 'chambre')
                                Aucune chambre n'est disponible pour les détails demandés
                            @else
                                Aucune salle n'est disponible pour les détails demandés
                            @endif
                        </div>

                    @endforelse

                </div>
                <div class="px-4 py-4 md:py-6 md:p-6 xl:p-8">

                    @if ($reservables->count() != 0)
                        <button id="button" type="submit"
                            class="w-full font-bold text-lg px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                            Continuer
                        </button>
                    @endif

                </div>

            </form>
        </div>
        <div class="sm:w-full md:w-1/3">
            <form action="{{ route('reservation.verification') }}" method="get"
                class="gap-5 shadow-lg p-3 max-w-xl mx-auto">
                @csrf
                @method('get')
                <h2 class="text-2xl mb-5 font-semibold text-center text-blue-600"></h2>
                <div class="  grid gap-3 w-full grid-cols-1  transition-all">
                    <div class="w-full mb-5">
                        <label for="date_arrivee" class=" duration-300   text-gray-500">
                            Date arrivée
                        </label>
                        <input type="date" name="date_arrivee" placeholder=" "
                            value="{{ old('date_arrivee', $data['date_arrivee']) }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        @error('date_arrivee')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class=" w-full mb-5">
                        <label for="date_depart" class=" duration-300  text-gray-500">
                            Date départ
                        </label>
                        <input type="date" name="date_depart" placeholder=" "
                            value="{{ old('date_depart', $data['date_depart']) }}"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        @error('date_depart')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="w-full mb-5">
                        <label for="typeReservable" class="whitespace-nowrap duration-300  text-gray-500">Type de
                            réservation</label>
                        <select id="choix" name="typeReservable"
                            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                            @if ($data['typeReservable'] == 'chambre')
                                <option value="chambre">Chambre</option>
                            @else
                                <option value="salle">Salle </option>
                            @endif
                        </select>
                        @error('typeReservable')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    @if ($data['typeReservable'] == 'chambre')
                        <div id="c1" class="flex-col w-full ">
                            <label for="adulte" class=" duration-300  text-gray-500">Adulte</label>
                            <select name="adulte"
                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                <option @if ($data['adulte'] == 1) selected @endif value="1">1 </option>
                                <option @if ($data['adulte'] == 2) selected @endif value="2">2 </option>
                                <option @if ($data['adulte'] == 3) selected @endif value="3">3 </option>
                                <option @if ($data['adulte'] == 4) selected @endif value="4">4 </option>
                            </select>
                            @error('adulte')
                                <span class="text-sm text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div id="c2" class="w-full mb-5">
                            <label for="enfant" class=" duration-300   text-gray-500">Enfant</label>
                            <select name="enfant"
                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                <option @if ($data['enfant'] == null) selected @endif>0 </option>
                                <option @if ($data['enfant'] == 1) selected @endif value="1">1
                                </option>
                                <option @if ($data['enfant'] == 2) selected @endif value="2">2
                                </option>
                                <option @if ($data['enfant'] == 3) selected @endif value="3">3
                                </option>
                                <option @if ($data['enfant'] == 4) selected @endif value="5">4
                                </option>
                                <option @if ($data['enfant'] == 5) selected @endif value="6">5
                                </option>
                            </select>
                            @error('enfant')
                                <span class="text-sm text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    @endif

                </div>
                <div class="">
                    <button id="button" type="submit"
                        class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>








    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</x-app-layout>
