<x-admin>

    @section('title', 'Rattacher un service ')


    <div class=" h-full  ">
        <div class="sm:mb-4">
            <a href="{{ route('admin.reservation.show', ['reservation' => $facture->reservation]) }}" class="inline-flex text-[#352513]">
                <svg class="w-6 h-6 mr-2  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
                retour
            </a>
        </div>

        <div class="mx-auto max-w-md shadow-xl px-6 py-6 bg-white border-0  sm:rounded-sm">
            <h1 class="text-1xl text-center font-bold mb-8">@yield('title')</h1>
            <form action="{{ route('admin.facture.ajouterService', ['facture' => $facture]) }}" method="POST">
                @csrf
                @method('post')


                <div class="relative z-0 w-full mb-5">
                    <select name="service"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->nom }}
                            </option>
                        @endforeach
                    </select>
                    <label for="service"
                        class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Service</label>
                    @error('service')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5">
                    <input type="text" name="nbre" placeholder="" value="{{ old('nbre') }}"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    <label for="nbre" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                        Quantité</label>
                    @error('nbre')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button id="button" type="submit"
                    class="w-full px-6 py-2 mt-2 text-md  transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                    Ajouter le service
                </button>
            </form>
        </div>
    </div>


</x-admin>
