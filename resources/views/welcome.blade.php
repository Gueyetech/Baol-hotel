<x-app-layout>

    <div class="py-8">
    </div>

    @section('titre', 'Acceuil')
    {{-- BEDUT DE CAROUSOLS --}}

    <div class="justify-center">
        <div class="w-full mx-auto ">
            <div class="sliderAx h-auto">
                <div id="slider-1" class="">
                    <div class="bg-cover bg-center  h-auto text-white py-36 px-10 object-fill"
                        style="background-image: url({{ asset('image/baniere.jpg') }})">

                    </div> <!-- container -->
                    <br>
                </div>

                <div id="slider-2" class="">
                    <div class="bg-cover bg-top  h-auto  py-36 px-10 object-fill"
                        style="background-image: url({{ asset('image/baniere.jpg') }})">

                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    {{-- FIN DE CAROUSOLS --}}


    {{-- DEBUT DE FORMULAIRE DE VERIFICATION DE COUT --}}
    <div class="px-2 sm:px-2 md:px-3">
        {{-- <div class="justify-center max-w-5xl -mt-20 mx-auto  shadow-md "> --}}
        <div class="justify-center max-w-5xl mt-10 mx-auto  shadow-md ">
            <form action="{{ route('reservation.verification') }}" method="get" id="form"
                class="w-full px-2  md:px-3 py-2 text-left bg-white grid gap-3  xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-6 ">
                @csrf
                @method('get')

                <div class="flex-col w-full">
                    <label for="adulte" class="pr-auto text-gray-500">Type</label>
                    <select id="choix" name="typeReservable"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">

                        <option selected value="chambre">Chambre</option>
                        <option value="salle">Salle </option>

                    </select>
                    @error('typeReservable')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="flex-col w-full">
                    <label for="date_arrivee" class=" duration-300   text-gray-500">
                        Date arrivée
                    </label>
                    <input type="date" name="date_arrivee" placeholder=" "
                        value="{{ old('date_arrivee', session()->get('data.date_arrivee')) }}"
                        class=" @error('date_arrivee')text-red-600 @enderror pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                </div>
                <div class="flex-col w-full">
                    <label for="date_depart" class=" duration-300  text-gray-500">
                        Date départ
                    </label>
                    <input type="date" name="date_depart" placeholder=" "
                        value="{{ old('date_depart', session()->get('data.date_depart')) }}"
                        class=" @error('date_depart')text-red-600 @enderror pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />

                </div>
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
                <div id="c2" class="flex-col w-full">
                    <label for="enfant" class=" duration-300   text-gray-500">Enfant</label>
                    <select name="enfant"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                        <option @if (session()->get('data.adulte') == null) selected @endif>0 </option>
                        <option @if (session()->get('data.adulte') == 1) selected @endif value="1">1 </option>
                        <option @if (session()->get('data.adulte') == 2) selected @endif value="2">2 </option>
                        <option @if (session()->get('data.adulte') == 3) selected @endif value="3">3 </option>
                        <option @if (session()->get('data.adulte') == 4) selected @endif value="4">4 </option>

                    </select>
                    @error('enfant')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>



                <button id="button" type="submit"
                    class="w-full transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    Vérifier
                </button>
            </form>
        </div>
        <script>
            // Obtenez une référence à l'élément <select>
            const selectElement = document.querySelector('#choix');

            // Obtenez une référence au formulaire
            const form = document.getElementById('form');

            // Obtenez une référence aux éléments <div> contenant le contenu
            const contenu1 = document.querySelector('#c1');
            const contenu2 = document.querySelector('#c2');
            // const contenu3 = document.querySelector('#c3');

            // Écoutez l'événement de changement de sélection
            selectElement.addEventListener('change', (event) => {
                const selectedOption = event.target.value;

                // Affichez le contenu correspondant en fonction de l'option sélectionnée
                if (selectedOption === 'chambre') {
                    form.classList.remove("md:grid-cols-4", "xl:grid-cols-4");
                    form.classList.add("md:grid-cols-6", "xl:grid-cols-6");

                    contenu1.style.display = 'block';
                    contenu2.style.display = 'block';
                    // contenu3.style.display = 'none';

                } else if (selectedOption === 'salle') {

                    form.classList.remove("md:grid-cols-6", "xl:grid-cols-6");
                    form.classList.add("md:grid-cols-4", "xl:grid-cols-4");

                    contenu1.style.display = 'none';
                    contenu2.style.display = 'none';
                    // contenu3.style.display = 'block';
                } else {
                    // Si aucune option n'est sélectionnée, masquez tous les contenus
                    contenu1.style.display = 'none';
                    contenu2.style.display = 'none';
                    contenu3.style.display = 'none';
                }
            });
        </script>
    </div>
    {{-- FIN DE FORMULAIRE DE VERIFICATION DE COUT --}}

    {{-- DEBUT LISTER CHAMBRE --}}
    <div class="w-full mt-5 py-5">
        <div class="mx-auto max-w-5xl">
            <div class="text-center wow " data-wow-delay="0.1s">
                <h1 class="mb-5 text-2xl font-bold  text-black">Explorer nos
                    <span class="text-[#baa538] text-uppercase">
                        CHAMBRES
                    </span>
                </h1>
            </div>
            <div class="grid  px-5 gap-3 sm:grid-cols-2  md:grid-cols-3 xl:grid-cols-3">

                @foreach ($chambres as $chambre)
                    <div class="flex-col h-full wow fadeInUp" data-wow-delay="0.3s">
                        <div
                            class="bg-white rounded-md shadow-sm hover:shadow-lg hover:shadow-[#baa538]  overflow-hidden">
                            <div class="">
                                <img class="w-full h-52" src="{{ asset($chambre->reservable->image) }}" alt="">
                                <div class="-mt-4">
                                    <small
                                        class="  bg-[#baa538] rounded-se-xl rounded-es-xl text-white text-md font-bold  py-3 px-3 ms-4">
                                        {{ number_format($chambre->reservable->tarif, 0, '.', ' ') }} CFA
                                    </small>
                                </div>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="flex justify-between mb-3">
                                    <h5 class="mb-0 font-bold text-lg xl:text-xl text-">
                                        {{ $chambre->reservable->numero }}</h5>
                                    {{-- <div class="inline-flex">
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                    </div> --}}
                                </div>
                                <div class="flex mb-3">
                                    <small class="border-l-2  p-1.5">
                                        <i class="fa fa-bed text-primary me-2"></i>
                                        Lit
                                    </small>
                                    <small class="border-l-2  p-1.5">
                                        <i class="fa fa-bed text-primary me-2"></i>
                                        Wifi
                                    </small>
                                    <small class="border-l-2  p-1.5">
                                        <i class="fa fa-bed text-primary me-2"></i>
                                        Mini bar
                                    </small>
                                </div>
                                <p class="text-left mb-3">{{ Str::limit($chambre->reservable->description, 100) }}
                                </p>
                                <div class="flex justify-between">
                                    @php
                                        $reservable = $chambre->reservable;
                                    @endphp
                                    <a href="{{ route('show.detaille', $reservable) }}"
                                        class="btn btn-sm border-transparent border-b-2  hover:border-[#352513] ease-linear font-bold hover:text-[#352513] py-2 mx-4"
                                        href="">Voir détaille </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
    {{-- FIN LISTER CHAMBRE --}}


    {{-- DEBUT LISTER SALLE --}}
    <div class="w-full py-5">
        <div class="mx-auto max-w-5xl">
            <div class="text-center wow " data-wow-delay="0.1s">
                <h1 class="mb-5 text-2xl font-bold  text-black">Explorer nos
                    <span class="text-[#baa538] text-uppercase">
                        SALLES
                    </span>
                </h1>
            </div>
            <div class="grid  px-5 gap-3 sm:grid-cols-2  md:grid-cols-3 xl:grid-cols-3">
                @foreach ($salles as $salle)
                    <div class="flex-col h-full wow fadeInUp" data-wow-delay="0.3s">
                        <div
                            class="bg-white rounded-md shadow-sm hover:shadow-lg hover:shadow-[#baa538]  overflow-hidden">
                            <div class="">
                                <img class="w-full h-52" src="{{ asset($salle->reservable->image) }}"
                                    alt="">
                                <div class="-mt-4">
                                    <small
                                        class="  bg-[#baa538] rounded-se-xl rounded-es-xl text-white text-md font-bold  py-3 px-3 ms-4">
                                        {{ number_format($salle->reservable->tarif, 0, '.', ' ') }} CFA
                                    </small>
                                </div>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="flex justify-between mb-3">
                                    <h5 class="mb-0 font-bold text-lg xl:text-xl text-">
                                        {{ $salle->reservable->numero }}</h5>
                                    {{-- <div class="inline-flex">
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-[#a0852e] dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                    </div> --}}
                                </div>
                                <div class="flex mb-3">
                                    <small class="border-l-2  p-1.5">
                                        Vidéo projecteur
                                    </small>
                                    <small class="border-l-2  p-1.5">
                                        Wifi
                                    </small>
                                    <small class="border-l-2  p-1.5">
                                        Sonorisation
                                    </small>

                                </div>
                                <p class="text-left mb-3">{{ Str::limit($salle->reservable->description, 100) }} </p>
                                <div class="flex justify-between">
                                    <a href="{{ route('show.detaille', $salle->reservable) }}"
                                        class="btn btn-sm border-transparent border-b-2  hover:border-[#352513] ease-linear font-bold hover:text-[#352513] py-2 mx-4"
                                        href="">Voir détaille </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- FIN LISTER SALLE --}}


    {{-- DEBUT LISTER IMAGE --}}
    <div class="w-full py-5">
        <div class="mx-auto max-w-5xl">
            <div class="text-center wow " data-wow-delay="0.1s">
                <h1 class="mb-5 text-2xl font-bold  text-black">Explorer nos
                    <span class="text-[#baa538] text-uppercase">
                        IMAGES
                    </span>
                </h1>
            </div>
            <div class="-m-1 flex flex-wrap md:-m-2">
                <div class="flex w-1/2 flex-wrap">
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="{{asset('image/room/room-14.png')}}" />
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="{{asset('image/room/room-13.jpg')}}" />
                    </div>
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="{{asset('image/Salles/salle-10.jpg')}}" />
                    </div>
                </div>
                <div class="flex w-1/2 flex-wrap">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="{{asset('image/Salles/salle-16.jpg')}}" />
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="{{asset('image/room/room-7.png')}}" />
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="{{asset('image/room/room-9.png')}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FIN LISTER IMAGE --}}


    {{-- DEBUT LISTER SERVICE --}}
    <div class="w-full py-5">
        <div class="mx-auto max-w-5xl">
            <div class="text-center wow " data-wow-delay="0.1s">
                <h1 class="mb-5 text-2xl font-bold  text-black">Explorer nos
                    <span class="text-[#baa538] text-uppercase">
                        SERVICES
                    </span>
                </h1>
            </div>
            <div class="grid  px-5 gap-3 sm:grid-cols-2  md:grid-cols-3 xl:grid-cols-3">

                <div class="flex-col bg-white  hover:bg-[#baa538] hover:text-white p-4 wow fadeInUp"
                    data-wow-delay="0.3s">
                    <div class=" justify-center">
                        <div class="w-20 h-20 mx-auto   items-center ">
                        </div>
                        <h5 class="mb-3 text-center text-xl">Le petit-déjeuner</h5>
                        <p class="text-body mb-0 text-center"> En plus de la chambre, le petit-déjeuner est un
                            incontournable.
                            Qu’il s’agisse d’un buffet à volonté ou d’un service à la carte, il est très apprécié des
                            voyageurs d’affaires et des familles. Optez pour des recettes de qualité et privilégiez les
                            produits locaux et de saison. </p>
                    </div>
                </div>
                <div class="flex-col bg-white  hover:bg-[#baa538] hover:text-white p-4 wow fadeInUp"
                    data-wow-delay="0.3s">
                    <div class=" justify-center">
                        <div class="w-20 h-20 mx-auto   items-center ">
                        </div>
                        <h5 class="mb-3 text-center text-xl">Le restaurant d’hôtel</h5>
                        <p class="text-body mb-0 text-center"> Un restaurant sur place attire une clientèle différente
                            et génère
                            des revenus supplémentaires. Proposez des plats locaux ou végétariens pour satisfaire vos
                            clients. </p>
                    </div>
                </div>
                <div class="flex-col bg-white  hover:bg-[#baa538] hover:text-white p-4 wow fadeInUp"
                    data-wow-delay="0.3s">
                    <div class=" justify-center">
                        <div class="w-20 h-20 mx-auto   items-center ">
                        </div>
                        <h5 class="mb-3 text-center text-xl">Le room service</h5>
                        <p class="text-body mb-0 text-center">Ce service permet aux clients de commander des repas ou
                            des boissons
                            directement dans leur chambre. C’est pratique pour ceux qui souhaitent dîner en privé. </p>
                    </div>
                </div>
                <div class="flex-col bg-white  hover:bg-[#baa538] hover:text-white p-4 wow fadeInUp"
                    data-wow-delay="0.3s">
                    <div class=" justify-center">
                        <div class="w-20 h-20 mx-auto   items-center ">
                        </div>
                        <h5 class="mb-3 text-center text-xl">La conciergerie virtuelle</h5>
                        <p class="text-body mb-0 text-center">Utilisez la technologie pour offrir des services de
                            conciergerie,
                            comme des recommandations de restaurants ou des réservations de spectacles. </p>
                    </div>
                </div>
                <div class="flex-col bg-white  hover:bg-[#baa538] hover:text-white p-4 wow fadeInUp"
                    data-wow-delay="0.3s">
                    <div class=" justify-center">
                        <div class="w-20 h-20 mx-auto  items-center ">
                        </div>
                        <h5 class="mb-3 text-center text-xl">Le parking et le transport</h5>
                        <p class="text-body mb-0 text-center"> Assurez-vous que vos clients disposent d’un parking
                            sécurisé et
                            proposez des services de navette vers les attractions locales.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FIN LISTER SERVICE --}}



    {{-- DEBUT LISTER AVIS --}}

    <div class="w-full mt-5 py-5">
        <div class="mx-auto max-w-5xl">

            <div class="text-center wow " data-wow-delay="0.1s">
                <h1 class="mb-5 text-2xl font-bold  text-black">
                    <span class="text-[#baa538] text-uppercase">
                        Avis
                    </span>
                    de nos clients
                </h1>
            </div>
            <style>
                .sample-slider img {
                    width: 100%;
                }
            </style>
            <div class="swiper sample-slider ">
                <div class="swiper-wrapper gap-3">
                    @foreach ($avis as $avi)
                        <div class="swiper-slide  max-w-md flex-shrink-0  w-full sm:w-auto">
                            <div class="flex items-center mb-2">
                                <img class=" flex-shrink-0 rounded" src="{{ asset($avi->client->user->image) }}"
                                    style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h3 class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 ">
                                        {{ $avi->client->user->prenom }} {{ $avi->client->user->nom }}
                                    </h3>
                                    {{-- <small>Profession</small> --}}
                                </div>
                            </div>
                            <div class="flex mb-3 items-center">
                                <p>{{ $avi->message }}</p>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="swiper-slide"><img src="{{ asset('image/baniere.jpg') }}"></div> --}}
                </div>
            </div>
        </div>
        <script>
            const swiper = new Swiper('.sample-slider', {
                loop: true,
                autoplay: {
                    delay: 0,
                    pauseOnMouseEnter: true, // added
                    disableOnInteraction: false, // added
                },
                speed: 3000,
                slidesPerView: 2,
            })
        </script>
    </div>

    {{-- FIN LISTER AVIS --}}

</x-app-layout>
