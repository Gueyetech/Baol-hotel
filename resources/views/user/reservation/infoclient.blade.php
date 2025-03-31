<x-app-layout>

    @section('title', 'Catégorie')

    <div class="py-8">
    </div>

    <div class="bg-cover bg-center text-white pt-20  object-fill"
        style="background-image: url({{ asset('image/gallery.jpg') }}">
    </div>

    {{--
    <div class="sm:mb-4 mt-4 ml-3">
        <a href="{{ route('reservation.retour', ['url' => 'acceuil']) }}" class="inline-flex text-[#352513]">
            <svg class="w-6 h-6 mr-2  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
            retour
        </a>
    </div> --}}
    <div class=" h-full block md:flex gap-2 md:gap-5 md:px-4 mt-4">
        <div class="sm:w-full md:w-2/3">
            <div class="">
                <h2 class="text-center text-2xl font-semibold mb-4 text-blue-600">Complétez votre
                    réservation
                </h2>
                <p class="text-sm text-center">Les champs avec un astérisque (*) sont requis</p>
            </div>

            <div class="mx-auto p-2 mt-2 max-w-lg bg-slate-200 shadow-sm mb-4  rounded-sm">
                <p>Vous avez déjà un compte?
                    <a class="font-semibold"
                        href="{{ route('reservation.loginForm', ['string' => json_encode($data)]) }}">
                        Identifiez-vous
                    </a>
                </p>
            </div>
            <div class="mx-auto w-full     sm:rounded-sm">
                <form action="{{ route('reservation.createClient', ['data' => $data]) }}" method="POST" class="gap-5">
                    @csrf
                    @method('post')


                    <div class="w-full mt-2  p-1 justify-center   mb-4  rounded-sm">
                        <div class="max-w-lg shadow-md bg-white p-3 rounded-md mx-auto ">
                            <h2 class="text-xl font-bold">Faisons connaissance</h2>
                            <div class="w-full py-2 mb-5">
                                <label for="genre" class=" duration-300  text-gray-500">Genre</label>
                                <select name="genre"
                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                                    <option value="Fiminin">Fiminin</option>
                                    <option value="Masculin">Masculin</option>
                                </select>
                                @error('genre')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="  w-full mb-5">
                                <label for="prenom" class=" duration-300   text-gray-500">
                                    Prenom
                                </label>
                                <input required type="text" name="prenom" placeholder="" value="{{ old('prenom') }}"
                                    class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                @error('prenom')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class=" z-0 w-full mb-5">
                                <label for="nom" class=" duration-300  text-gray-500">
                                    nom
                                </label>
                                <input required type="text" name="nom" placeholder="" value="{{ old('nom') }}"
                                    class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                @error('nom')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="w-full mt-2  p-1 justify-center   mb-4  rounded-sm">
                        <div class="max-w-lg shadow-md bg-white p-3 rounded-md mx-auto ">
                            <h2 class="text-xl font-bold">Comment vous contacter ?</h2>
                            <div class=" w-full mb-5">
                                <label for="email" class=" duration-300  text-gray-500">
                                    Email
                                </label>
                                <input required type="text" name="email" placeholder="" value="{{ old('email') }}"
                                    class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                @error('email')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="w-full mb-5">
                                <label for="tel" class=" duration-300  text-gray-500">
                                    Telephone
                                </label>
                                <input required type="text" name="tel" placeholder=""
                                    value="{{ old('tel') }}"
                                    class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                @error('tel')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-2  p-1 justify-center   mb-4  rounded-sm">
                        <div class="max-w-lg shadow-md bg-white p-3 rounded-md mx-auto ">
                            <h2 class="text-xl font-bold">Où résidez vous ?</h2>
                            <div class="  w-full mb-5">
                                <label for="adresse" class=" duration-300  text-gray-500">
                                    Adresse</label>
                                <input required type="text" name="adresse" placeholder=""
                                    value="{{ old('adresse') }}"
                                    class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                @error('adresse')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="w-full mb-5">
                                <label for="ville" class=" duration-300 text-gray-500">
                                    Ville
                                </label>
                                <input required type="text" name="ville" placeholder=""
                                    value="{{ old('ville') }}"
                                    class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                @error('ville')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="w-full mb-5">
                                <label for="pays" class=" duration-300 text-gray-500">
                                    Pays
                                </label>
                                <input required type="text" name="pays" placeholder=""
                                    value="{{ old('pays') }}"
                                    class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                                @error('pays')
                                    <span class="text-sm text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="px-4 py-4 md:py-6 md:p-6 xl:p-8">
                        <button id="button" type="submit"
                            class="w-full font-bold text-lg px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                            Continuer
                        </button>
                    </div>
                </form>
            </div>
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





</x-app-layout>
