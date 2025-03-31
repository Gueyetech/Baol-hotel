<x-app-layout>
    @section('title', 'detaille reservable')


    <div class="py-6">
    </div>
    <div class="bg-cover  text-white pt-16  object-fill" style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-4 text-center text-md md:text-2xl font-bold">
            EFFECTUER LE <span class="text-[#baa538] text-uppercase">
                PAIEMENT </span>
            <h1>
    </div>


        {{-- -mt-20 --}}

        <div class="w-full">
            <div class="justify-center max-w-3xl  mx-auto ">
                <div class="w-full  px-2 py-2 text-left   gap-3  ">
                    <div class=" ">
                        <div class=" p-2 text-center pb-20 text-xl lg:text-3xl w-full rounded-md bg-[#F7BE38] ">
                            BAOL HOTEL
                        </div>
                        <div class="-mt-11 mx-2 shadow-lg rounded-md p-3 bg-white">
                            <div class="m-2 flex justify-between">
                                <h2 class="font-bold text-xl md:text-2xl">Reservation: </h2>
                                <spam class=" text-xl md:text-2xl font-bold text-right">{{ $data['typeReservable'] }}
                                </spam>
                            </div>
                            <div class="p-2 flex justify-between">
                                <h2 class="font-bold text-xl md:text-2xl">Tarif: </h2>
                                <spam class=" text-xl md:text-2xl font-bold text-right">
                                    {{ number_format($data['tarif'], 0, '.', ' ') }} CFA
                                </spam>
                            </div>
                            <div class="p-2 flex justify-between">
                                <h2 class="font-bold text-xl md:text-2xl">Séjour: </h2>
                                <spam class=" text-xl md:text-2xl font-bold text-right">
                                    {{ $data['nombreDeJours'] }} jour(s)
                                </spam>
                            </div>
                            <div class="p-2 flex justify-between border-t-2 mt-10 border-t-[#F7BE38]">
                                <h2 class="font-bold text-xl md:text-2xl">Total </h2>
                                <spam class=" text-xl md:text-2xl font-bold text-right">
                                    {{ number_format($data['nombreDeJours'] * $data['tarif'], 0, '.', ' ') }} CFA soit {{number_format($data['nombreDeJours'] * $data['tarif']/500, 0, '.', ' ')}} $
                                </spam>
                            </div>
                            <div class="">

                            </div>
                        </div>

                    </div>




                    <div class=" w-full ">

                        <div class=" bg-white flex items-start justify-center m-2">
                            <form action="{{ route('make.payment', ['data' => $data]) }}" method="POST"
                                class="w-full rounded-lg p-2  shadow-lg  text-gray-700">
                                @csrf @method('post')

                                <button id="button" type="submit"
                                    class="w-full md:text-2xl  justify-center text-gray-900 bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:ring-[#F7BE38]/50 font-medium rounded-lg text-xl px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                                    <svg class="w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab"
                                        data-icon="paypal" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 384 512">
                                        <path fill="currentColor"
                                            d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4 .7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9 .7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z">
                                        </path>
                                    </svg>
                                    <p class="w-full">Payer avec PayPal</p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
