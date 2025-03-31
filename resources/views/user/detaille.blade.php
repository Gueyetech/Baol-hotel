<x-app-layout>
    @section('titre', 'Détaille reservable')


    <div class="py-6">
    </div>

      <div class="bg-cover  text-white pt-16  object-fill" style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-4 text-center text-md md:text-2xl font-bold">
          DETAILLE   <span class="text-[#baa538] text-uppercase">
                {{ $type }} </span>
            <h1>
    </div>

    @include('user.toast')

    <div class="md:flex gap-3 p-5 ">
        <div class="w-full md:w-2/3  mx-auto ">
            <div class="h-[360px] mb-4">
                <img class="w-full h-full object-cover" src="{{ asset($reservable->image) }}" alt="reservable">
            </div>
            <div class="px-4 mt-10 mb-4">
                <div class="block sm:flex md:flex  mb-4 items-center justify-between">
                    <h2 class="text-xl md:text-2xl font-bold text-black dark:text-white ">{{ $reservable->numero }}
                    </h2>
                    <h2 class="text-xl md:text-2xl font-bold text-[#6c5227] dark:text-white ">
                        {{ number_format($reservable->tarif, 0, '.', ' ') }} CFA
                    </h2>
                </div>


                <div class="mb-4 space-y-3">
                    <!-- Détails du reservable(chambre ou salle) -->
                    <div class="">
                        <span class="mr-14 font-bold text-black dark:text-gray-300">Catégorie: </span>
                        <span class="text-gray-600 dark:text-gray-300">{{ $reservable->categorie->nom }}</span>
                    </div>
                    <div class="">
                        <span class="mr-16 font-bold text-black dark:text-gray-300">Capacité:</span>
                        <span class="text-gray-600 dark:text-gray-300">Maximum {{ $reservable->capacite }}</span>
                    </div>
                    <div>
                        <span class="mr-4 font-bold text-black dark:text-gray-300">Services offerts:</span>
                        <span class="text-gray-600 dark:text-gray-300">Wifi, Télèvision, </span>
                    </div>

                </div>
                <div>
                    <!-- Description du reservable -->
                    <span class="font-bold text-black dark:text-gray-300">Description:</span>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                        {{ $reservable->description }} </p>
                </div>
            </div>
            <div class="flex-row shadow-lg  max-w-2xl mb-6 items-center   justify-center">
                <h2 class="text-xl max-w-md px-2 py-2 md:text-2xl font-bold text-black dark:text-white ">Donner votre
                    avis</h2>

                <!-- Formulaire d'avis -->
                <form action="{{ route('avis') }}" method="POST" class="w-full  px-2 py-2   text-left   md:gap-3  ">
                    @csrf
                    @method('post')
                    <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                        <div class="flex-col w-full ">
                            <label for="prenom" class="pr-auto text-gray-500">Nom complet</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}"
                                class=" border-black pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-transparent" />
                            @error('prenom')
                                <spam class="text-red-500">{{ $message }}</pam>
                                @enderror
                        </div>
                        <div class="flex-col w-full ">
                            <label for="evaluation" class="pr-auto text-gray-500">Evaluation</label>
                            <select name="evaluation"
                                class="@error('evaluation')  text-red-600 @enderror border-black pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-transparent">
                                <option value="1"> 1</option>
                                <option value="2"> 2</option>
                                <option value="3"> 3</option>
                                <option value="4"> 4</option>
                                <option selected value="5"> 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-col mt-3  w-full ">
                        <label for="avis" class="pr-auto text-gray-500">Avis</label>
                        <textarea type="text" name="avis"
                            class=" border-black pt-3 pb-2  w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-transparent">
                            {{ old('avis') }}
                        </textarea>
                        @error('avis')
                            <spam class="text-red-500">{{ $message }}</pam>
                            @enderror
                    </div>

                    <button id="button" type="submit"
                        class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Envoyer
                    </button>
                </form>
                <!-- Fin formulaire d'avis -->

            </div>
        </div>

        <div class="mx-auto md:flex-1   sm:rounded-sm">
            <form action="{{ route('reservation.verification') }}" method="get"
                class="gap-5 shadow-lg p-3 max-w-xl mx-auto">
                @csrf
                @method('get')
                <h2 class="text-2xl mb-5 font-semibold text-center text-[#352513]">Réserver maintenant</h2>
                <div class="  grid gap-3 w-full sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-2 transition-all">
                    <div class="w-full mb-5">
                        <label for="date_arrivee" class=" duration-300   text-gray-500">
                            Date arrivée
                        </label>
                        <input type="date" name="date_arrivee" placeholder=" "
                            value="{{ old('date_arrivee', session()->get('data.date_arrivee')) }}"
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
                            value="{{ old('date_depart', session()->get('data.date_depart')) }}"
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
                            @if ($type == 'CHAMBRE')
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
                    @if ($type == 'CHAMBRE')
                        <div id="c1" class="flex-col w-full ">
                            <label for="adulte" class=" duration-300  text-gray-500">Adulte</label>
                            <select name="adulte"
                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                <option @if (session()->get('data.adulte') == 1) selected @endif value="1">1 </option>
                                <option @if (session()->get('data.adulte') == 2) selected @endif value="2">2 </option>
                                <option @if (session()->get('data.adulte') == 3) selected @endif value="3">3 </option>
                                <option @if (session()->get('data.adulte') == 4) selected @endif value="4">4 </option>
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
                                <option @if (session()->get('data.enfant') == null) selected @endif>0 </option>
                                <option @if (session()->get('data.enfant') == 1) selected @endif value="1">1 </option>
                                <option @if (session()->get('data.enfant') == 2) selected @endif value="2">2 </option>
                                <option @if (session()->get('data.enfant') == 3) selected @endif value="3">3 </option>
                                <option @if (session()->get('data.enfant') == 4) selected @endif value="5">4 </option>
                                <option @if (session()->get('data.enfant') == 5) selected @endif value="6">5 </option>
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
                        Recherche
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const selectElement = document.querySelector('#choix');
        const contenu1 = document.querySelector('#c1');
        const contenu2 = document.querySelector('#c2');

        selectElement.addEventListener('change', (event) => {
            const selectedOption = event.target.value;
            if (selectedOption === 'chambre') {
                contenu1.style.display = 'block';
                contenu2.style.display = 'block';
            } else if (selectedOption === 'salle') {
                contenu1.style.display = 'none';
                contenu2.style.display = 'none';
            }
        });
    </script>




</x-app-layout>
