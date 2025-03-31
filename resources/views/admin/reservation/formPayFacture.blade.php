<x-admin>

    @section('title', 'Payer une facture ')

    <div class=" h-full  ">
        <div class="sm:mb-2">
            <a href="{{ route('admin.reservation.show', ['reservation' => $facture->reservation]) }}"
                class="inline-flex text-[#352513]">
                <svg class="w-6 h-6 mr-2  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
                retour
            </a>
        </div>
        <div class="mx-auto max-w-md shadow-xl px-2 py-4 h-full bg-white border-0  sm:rounded-sm">
            {{-- <h1 class="text-1xl text-center font-bold mb-8">@yield('title')</h1> --}}
            <div class="mb-4 py-3">
                <div class="w-full text-center text-xl rounded-md bg-[#c9ba46] pt-4 font-bold pb-12">
                    Paiement de facture
                </div>
                <div class="mx-3 bg-white -mt-10 rounded-md">
                    <div class="m-2 flex justify-between">
                        <h2 class="font-semibold text-lg">Reservation: </h2>
                        <spam class=" text-lg font-bold text-right">{{$facture->reservation->reference}}</spam>
                    </div>
                    <div class="m-2 flex justify-between">
                        <h2 class="font-semibold text-lg">Facture: </h2>
                        <spam class=" text-lg font-bold text-right">{{$facture->ref}}</spam>
                    </div>
                    <div class="m-2 flex justify-between">
                        <h2 class="font-semibold text-lg">Montant: </h2>
                        <spam class=" text-lg font-bold text-right">{{number_format($facture->montant,'0','.',' ')}} CFA</spam>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.facture.payerFacture', ['facture' => $facture]) }}" method="POST">
                @csrf
                @method('post')

                <button id="button" type="submit"
                    class="w-full text-center px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    Valider le paiement
                </button>
            </form>
        </div>
    </div>


</x-admin>
