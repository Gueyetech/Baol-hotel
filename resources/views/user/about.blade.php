<x-app-layout>
    @section('titre', 'A propos')

    <div class="py-8">
    </div>
    <div class="bg-cover  text-white pt-16  object-fill" style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-4 text-center text-md md:text-2xl font-bold">
            A PROPOS DE <span class="text-[#baa538] text-uppercase">
                BAOL HOTEL </span>
            <h1>
    </div>

    <div class=" font-sans flex   ">
        <div x-data="{ openTab: 1 }" class=" mt-3 w-full">
            <div class=" mt-1 overflow-x-auto mb-4 justify-center mx-auto">
                <div class=" max-w-xl shadow mx-auto justify-center pb-2 flex space-x-1 p-2 bg-white rounded-sm ">
                    <button x-on:click="openTab = 1"
                        :class="{ 'border-b-4 border-[#8a732a] bg-[#e5e3a3]': openTab === 1 }"
                        class=" py-2 px-4 border-transparent border-b-4 focus:outline-none focus:shadow-transparent transition-all duration-300">
                        Déscription
                    </button>
                    <button x-on:click="openTab = 2"
                        :class="{ 'border-b-4 border-[#8a732a] bg-[#e5e3a3]': openTab === 2 }"
                        class=" py-2 px-4 border-transparent border-b-4 focus:outline-none focus:shadow-transparent transition-all duration-300">
                        Localisation
                    </button>
                    <button x-on:click="openTab = 3"
                        :class="{ 'border-b-4 border-[#8a732a] bg-[#e5e3a3]': openTab === 3 }"
                        class=" py-2 px-4 border-transparent border-b-4 focus:outline-none focus:shadow-transparent transition-all duration-300">
                        Galerie
                    </button>

                </div>
            </div>
            <div class="max-w-6xl mx-auto">
                <div x-show="openTab === 1" class="gap-2 duration-300  p-4 ">
                    <div class=" max-w-3xl text-center mt-6 mx-auto mb-3 p-2">
                        <p class="text-gray-700">Le Baol Hotel est un havre de tranquillité niché dans le
                            quartier Mbaké Khewar à Diourbel, au Sénégal. Cet établissement propose une expérience
                            authentique et chaleureuse pour les voyageurs en quête de tranquilité. Voici quelques
                            caractéristiques qui définissent lee Baol:
                        </p>
                    </div>
                    <div
                        class=" grid gap-3 w-full mt-10 grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-3 transition-all">

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                Emplacement Paisible:
                            </h2>
                            <p>Situé à proximité de la ville de Diourbel, le Campement Touristique Le Baol offre un
                                cadre
                                paisible et serein. Les voyageurs peuvent se détendre dans un environnement naturel et
                                échapper à l’agitation urbaine.
                            </p>
                        </div>

                        <div class="items-center flex-col shadow">
                            <img src="{{ asset('image/room/room-1.jpg') }}"
                                class="h-auto w-full rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div class="hidden xl:hidden items-center sm:flex md:flex ">
                            <img src="{{ asset('image/room/room-1.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                Hébergement Confortable:
                            </h2>
                            <p> Le campement propose des chambres ventilées et climatisées. Les tarifs sont abordables
                                et
                                defis toute concurence.</p>
                        </div>

                        <div class=" items-center flex sm:hidden md:hidden xl:flex ">
                            <img src="{{ asset('image/room/room-12.png') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                Ambiance Locale:
                            </h2>
                            <p>Le Baol célèbre la culture sénégalaise. Les visiteurs peuvent s’immerger dans la vie
                                locale,
                                goûter à la cuisine traditionnelle et découvrir les coutumes et les traditions du
                                Sénégal.
                            </p>
                        </div>

                        <div class="hidden xl:hidden items-center sm:flex md:flex ">
                            <img src="{{ asset('image/room/room-2.png') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>
                        <div class="hidden xl:hidden items-center sm:flex md:flex ">
                            <img src="{{ asset('image/room/room-14.png') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div class=" items-center flex sm:hidden md:hidden xl:flex ">
                            <img src="{{ asset('image/room/room-14.png') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                Proximité de la Nature:
                            </h2>
                            <p>Le campement est entouré de verdure et offre un accès facile à la nature environnante.
                                Les
                                voyageurs peuvent profiter de promenades relaxantes et explorer les environs.</p>
                        </div>


                        <div class=" items-center flex sm:hidden md:hidden xl:flex ">
                            <img src="{{ asset('image/room/room-4.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                Cuisine Locale
                            </h2>
                            <p>Le restaurant du campement propose une variété de plats sénégalais authentiques. Les
                                voyageurs peuvent savourer des mets tels que le thieboudienne, le yassa, et le couscous
                                de
                                mil. Les repas sont préparés avec des ingrédients frais et locaux</p>
                        </div>
                        <div class="hidden xl:hidden items-center sm:flex md:flex ">
                            <img src="{{ asset('image/room/room-6.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div class="hidden xl:hidden items-center sm:flex md:flex ">
                            <img src="{{ asset('image/room/room-6.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div class=" items-center flex sm:hidden md:hidden xl:flex ">
                            <img src="{{ asset('image/room/room-6.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                Activités Culturelles:
                            </h2>
                            <p>
                                Activités Culturelles: Le Baol organise des soirées culturelles avec des danses
                                traditionnelles, des spectacles de tam-tam, et des contes. C’est l’occasion idéale pour
                                les
                                visiteurs d’en apprendre davantage sur la culture sénégalaise.
                            </p>
                        </div>



                        <div class=" items-center flex sm:hidden md:hidden xl:flex ">
                            <img src="{{ asset('image/room/room-15.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                <p>
                                    L'hotel propose des excursions vers des sites historiques et naturels tels
                                    que le Lac Rose, la Forêt de Bandia, et les Chutes de Dindefelo. Les guides locaux
                                    partagent
                                    des anecdotes intéressantes sur ces lieux.
                                </p>
                        </div>

                        <div class="hidden xl:hidden items-center sm:flex md:flex ">
                            <img src="{{ asset('image/room/room-6.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>
                        <div class="hidden xl:hidden items-center sm:flex md:flex ">
                            <img src="{{ asset('image/room/room-13.jpg') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div class=" items-center flex sm:hidden md:hidden xl:flex ">
                            <img src="{{ asset('image/room/room-12.png') }}"
                                class=" rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                alt="" />
                        </div>

                        <div
                            class="text-center hover:bg-[#baa538] hover:text-white items-center h-full flex-col hover:shadow-md p-2">
                            <h2 class="text-xl font-bold mb-2 text-[#352513] hover:text-[#352513]">
                                <p>
                                    L’équipe de l'hotel est accueillante et attentive aux besoins des voyageurs. Ils
                                    sont
                                    prêts
                                    à rendre votre séjour mémorable.
                                </p>
                        </div>
                    </div>

                    <div class="max-W-4xl text-center p-2 mt-5">
                        <p>
                            Que vous soyez en quête d’une escapade paisible ou d’une immersion culturelle, le Campement
                            Touristique Le Baol vous accueille avec chaleur et authenticité. Profitez de votre séjour au
                            cœur du
                            Sénégal
                        </p>
                    </div>


                </div>

                <div x-show="openTab === 2" class=" transition-all duration-300  p-4 ">
                    <div
                        class="grid gap-3 items-center w-full sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-2 transition-all">

                        <div class="flex-col justify-center  ">
                            <div id="map" style="height:400px;width:100%;"></div>
                        </div>

                        <div class="flex-col  ">
                            <div class=" w-full shadow-sm mx-auto ">
                                <div class="text-center  mb-3 p-2">
                                    <a href="{{ route('acceuil') }}"
                                        class="text-2xl text-black text-center font-bold">
                                        BAOL <spam class="text-[#baa538]">HOTEL</spam>
                                    </a>

                                    <p class="text-gray-700">Le Baol Hotel est un havre de tranquillité niché dans le
                                        quartier Mbaké Khewar à Diourbel, au Sénégal. Cet établissement propose une
                                        expérience
                                        authentique et chaleureuse pour les voyageurs en quête de tranquilité. Voici
                                        quelques
                                        caractéristiques qui définissent lee Baol:
                                    </p>
                                </div>

                                <div class="p-2">
                                    <div class="text-left p-2">
                                        <p class="text-gray-700 inline-flex">
                                            <svg class="w-6 h-6 mr-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            10, Rue Gawane, Mbacké
                                        </p>
                                        <p class="text-gray-700 ml-10"> BP 3380 Diourbel SÉNÉGAL</p>
                                        <p class="text-gray-700 ml-10">COORDONNÉES GPS : 14.667778, -17.431611</p>
                                    </div>
                                    <div class="text-left p-2">
                                        <p class="items-center text-gray-700 inline-flex">
                                            <svg className="w-h-8 h-8 mr-4 text-gray-800 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z" />
                                            </svg>

                                            <spam class="ml-4">
                                                +221 77 762 21 345 / +221 78 762 35 21
                                            </spam>
                                        </p>
                                        <p class="flex mt-3 items-center text-gray-700">
                                            <svg class="w-6 h-6 mr-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z" />
                                                <path
                                                    d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z" />
                                            </svg>

                                            reservation@baolhotel.sn
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="openTab === 3" class="transition-all duration-300  p-4  ">
                    <div class="w-full justify-center  ">
                        <div class="min-w-xs mt-1 overflow-x-auto  justify-center ">
                            <div x-data="{ currentImage: '{{ asset('image/room/room-1.jpg') }}' }" class="w-full mx-auto max-w-4xl">

                                <div class="mb-4">
                                    <img x-bind:src="currentImage"
                                        class="w-full h-auto mx-auto rounded-lg shadow-lg" alt="Main Image">
                                </div>
                                <div class="overflow-x-auto ">
                                    <div class="flex flex-nowrap justify-center ">
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-1.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-1.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-2.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-2.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-3.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-3.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-4.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-4.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-5.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-5.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-6.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-6.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-7.png') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-7.png') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-8.png') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-8.png') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-9.png') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-9.png') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-10.png') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-10.png') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>

                                        <div x-on:click="currentImage = '{{ asset('image/room/room-12.png') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-12.png') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-13.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-13.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-14.png') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-14.png') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-15.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-15.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-16.jpg') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-16.jpg') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                        <div x-on:click="currentImage = '{{ asset('image/room/room-17.png') }}';"
                                            class="cursor-pointer w-14 h-14 mb-2 mr-2">
                                            <img src="{{ asset('image/room/room-17.png') }}"
                                                class="w-full h-full object-cover rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30"
                                                alt="Thumbnail Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








        {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}
</x-app-layout>
