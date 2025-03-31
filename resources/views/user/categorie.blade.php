<x-app-layout>

    @section('titre', 'Catégorie de chambre et de salle')

    <div class="py-8">
    </div>
    <div class="bg-cover  text-white pt-16  object-fill" style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-4 text-center text-md md:text-2xl font-bold">
            NOS CATEGORIES DE
            <span class="text-[#baa538] text-uppercase">
                CHAMBRE ET DE SALLE
            </span>
            <h1>
    </div>

    <div class="font-sans flex  items-top ">
        <div x-data="{ openTab: 1 }" class=" mt-3 w-full">
            <div class="min-w-xs mt-1 mx-16 overflow-x-auto mb-4 justify-center ">
                <div class=" w-fit  mx-auto justify-center pb-2 flex space-x-1 p-2 bg-white rounded-sm shadow-sm">


                    @foreach ($categories as $categorie)
                        <button x-on:click="openTab = {{ $loop->index + 1 }}"
                            :class="{ 'border-b-4 border-[#8a732a] bg-[#e5e3a3]': openTab === {{ $loop->index + 1 }} }"
                            class="whitespace-nowrap py-2 px-4 border-transparent border-b-4 focus:outline-none focus:shadow-transparent transition-all duration-300">
                            {{ $categorie->nom }} ({{ $categorie->reservables->count() }})
                        </button>
                    @endforeach

                </div>
            </div>
            <div>
                @php
                    $j = 0;
                @endphp

                @foreach ($categories as $categorie)
                    @php
                        $j++;
                    @endphp
                    <div x-show="openTab === {{ $j }}"
                        class=" grid gap-4 px-5 justify-center max-w-6xl mx-auto sm:grid-cols-1 md:grid-cols-3 xl:grid-cols-3 duration-300  p-4 rounded-sm  ">
                        @foreach ($categorie->reservables as $reservable)
                            <div class="flex-col h-full wow fadeInUp" data-wow-delay="0.3s">
                                <div
                                    class="bg-white rounded-md shadow-md hover:shadow-lg hover:shadow-[#baa538]  overflow-hidden">
                                    <div class="">
                                        <img class="w-full h-52" src="{{ asset($reservable->image) }}" alt="">
                                        <div class="-mt-4">
                                            <spam
                                                class="  bg-[#baa538] rounded-se-xl rounded-es-xl text-white text-md font-bold  py-3 px-3 ms-4">
                                                {{ number_format($reservable->tarif, '0', '.', ' ') }} CFA
                                            </spam>
                                        </div>
                                    </div>
                                    <div class="p-4 mt-2">
                                        <div class="flex justify-between items-center mb-3">
                                            <h5 class="mb-0 font-bold text-lg xl:text-xl text-">
                                                {{ $reservable->numero }}
                                            </h5>
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
                                        <p class="text-left mb-3">Erat ipsum justo amet duo et elitr dolor, est duo duo
                                            eos lorem
                                            sed diam stet diam sed stet lorem.</p>
                                        <div class="flex justify-between">
                                            <a href="{{ route('show.detaille', $reservable) }}"
                                                class="btn btn-sm border-transparent border-b-2  hover:border-[#352513] ease-linear font-bold hover:text-[#352513] py-2 mx-4">
                                                Voir
                                                @if ($reservable->salle == null)
                                                    chambre
                                                @else
                                                    salle
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>







</x-app-layout>
