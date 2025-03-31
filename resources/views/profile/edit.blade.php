<x-app-layout>

    <div class="py-8">
    </div>

    @section('titre', 'Mon profil')

    <div class="max-w-6xl mx-auto p-4 sm:p-8 gap-4 sm:gap-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

        {{-- Space reserver pour la modification du photo de profile --}}

        <div class="w-full ">
            <form method="post" id="form" action="{{ route('profile.changerImage') }}"
                class="  w-full h-full shadow-sm p-2  " enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="text-center justify-center w-full h-full">
                    <div class="  gap-4 items-center w-full h-full ">
                        <img src="{{ asset($user->image) }}" alt="Image de profil"
                            class=" max-w-80 rounded-full mx-auto  profile-image">
                        <label for="Image" class="mt-6 inline-block cursor-pointer">
                            <span
                                class="inline-block rounded-md px-6 py-2 mt-2 text-md mr-3 transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                                Changer l'image
                            </span>
                            <input type="file" id="Image" name="image" class="hidden">
                        </label>

                    </div>
                </div>
            </form>
            <script>
                const form = document.getElementById('form');
                const ImageInput = document.getElementById('Image');
                ImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const Image = document.querySelector('.profile-image');
                            Image.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                        form.submit();
                    }
                });
            </script>

        </div>

        {{-- Space reserver pour la modification des informations personnel --}}

        <div class="w-full bg-white">
            <form method="post" action="{{ route('profile.information') }}" class=" shadow-sm p-2  ">
                @csrf
                @method('post')
                <h2 class="text-xl font-bold">Information personnel</h2>
                <div class=" w-full mt-3 py-2 mb-5">
                    <label for="genre" class="   text-gray-500">Genre</label>
                    <select name="genre"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                        <option @if ($user->genre == 'Fiminin') selected @endif value="Fiminin">Fiminin
                        </option>
                        <option @if ($user->genre == 'Masculin') selected @endif value="Masculin">Masculin
                        </option>

                        @error('genre')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                </div>

                <div class=" w-full mb-5 my-10">
                    <label for="nom" class=" duration-300  text-gray-500">
                        Prénom
                    </label>
                    <input required type="text" name="prenom" placeholder=""
                        value="{{ old('prenom', $user->prenom) }}"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    @error('prenom')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="  w-full mb-5">
                    <label for="nom" class="   text-gray-500">
                        Nom
                    </label>
                    <input required type="text" name="nom" placeholder=""
                        value="{{ old('nom', Auth::user()->nom) }}"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    @error('nom')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="w-full mt-auto flex items-center">
                    <button id="button" type="submit"
                        class=" px-6 py-2 mt-2 text-md mr-3 transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Modifier
                    </button>

                    @if (session('status') === 'profile-information')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Vos informations personnel ont étè avec succés') }}
                        </p>
                    @endif

                </div>
            </form>
        </div>

        {{-- Space reserver pour la modification des informations de contact --}}

        <div class="w-full bg-white">
            <form method="post" action="{{ route('profile.contact') }}" class=" p-2  ">
                @csrf
                @method('post')
                <h2 class="text-xl font-bold">Comment vous contacter ?</h2>
                <div class="w-full mt-3 py-2 mb-5">
                    <label for="email" class=" duration-300  text-gray-500">
                        Email
                    </label>
                    <input required type="text" name="email" placeholder=""
                        value="{{ old('email', $user->email) }}"
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
                    <input required type="text" name="tel" placeholder="" value="{{ old('tel', $user->tel) }}"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    @error('tel')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="w-full mt-auto flex items-center">
                    <button id="button" type="submit"
                        class=" px-6 py-2 mt-2 text-md mr-3 transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Modifier
                    </button>

                    @if (session('status') === 'profile-contact')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Vos informations de contact ont étè avec succés') }}
                        </p>
                    @endif

                </div>
            </form>

        </div>


        {{-- Space reserver pour la modification de l'adresse --}}
        <div class="w-full bg-white">
            <form method="post" action="{{ route('profile.adresse') }}" class=" p-2  ">
                @csrf
                @method('post')
                <h2 class="text-xl font-bold">Où résidez vous ?</h2>
                <div class="w-full mt-3 py-2 mb-5">
                    <label for="adresse" class=" duration-300  text-gray-500">
                        Adresse</label>
                    <input required type="text" name="adresse" placeholder=""
                        value="{{ old('adresse', $user->adresse) }}"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    @error('adresse')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                @if ($user->client != null)
                    <div class="w-full mb-5">
                        <label for="ville" class=" duration-300 text-gray-500">
                            Ville
                        </label>
                        <input required type="text" name="ville" placeholder=""
                            value="{{ old('ville', $user->client->ville) }}"
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
                            value="{{ old('pays', $user->client->pays) }}"
                            class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                        @error('pays')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                @endif
                <div class="w-full mt-auto flex items-center">
                    <button id="button" type="submit"
                        class=" px-6 py-2 mt-2 text-md mr-3 transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Modifier
                    </button>

                    @if (session('status') === 'profile-adresse')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Vos informations de votre adresse ont étè avec succés') }}
                        </p>
                    @endif

                </div>
            </form>

        </div>


        {{-- Space reserver pour la modification de mot de passe --}}

        <div class="w-full bg-white">
            <form method="post" action="{{ route('password.update') }}" class="p-2 ">
                @csrf
                @method('put')

                <h2 class="text-xl font-bold">Modifier votre mot de passe ?</h2>
                <div class=" mt-4  w-full mb-5">
                    <label class=" duration-300  text-gray-500">
                        Votre mot de passe actuel</label>
                    <input required type="password" name="current_password" placeholder=""
                        value="{{ old('current_password') }}"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    @error('current_password')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="w-full mb-5">
                    <label for="ville" class=" duration-300 text-gray-500">
                        Votre nouveau mot de passe
                    </label>
                    <input required type="password" name="password" placeholder="" value="{{ old('password') }}"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    @error('password')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="w-full mb-5">
                    <label for="pays" class=" duration-300 text-gray-500">
                        Confirmer votre mot de passe
                    </label>
                    <input required type="password" name="password_confirmation" placeholder=""
                        value="{{ old('password_confirmation') }}"
                        class="pt-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200" />
                    @error('password_confirmation')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="w-full mt-auto flex items-center">
                    <button id="button" type="submit"
                        class=" px-6 py-2 mt-2 text-md mr-3 transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none">
                        Modifier
                    </button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">
                            {{ __('Votre mot de passe a étè modifié avec succés!') }}</p>
                    @endif
                </div>
            </form>
        </div>

    </div>

</x-app-layout>
