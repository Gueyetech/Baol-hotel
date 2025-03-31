<x-guest-layout>
                @section('titre', 'S\'inscrire')

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <!-- Image -->

        <div class="relative z-0 w-full mb-5 text-center justify-center">
            <div class=" mx-auto  max-w-64 gap-4 items-center w-fit ">
                <img src="{{ asset('bh/user.jpeg') }}" alt="Image de profil" class=" h-52  profile-image">
                <label for="Image" class="mt-6 inline-block cursor-pointer">
                    <span class="inline-block px-4 py-2 rounded-md bg-gray-800 text-white hover:bg-gray-700">
                        Ajouter l'image
                    </span>
                    <input type="file" id="Image" name="image" class="hidden">
                </label>
                @error('image')
                    <span class="text-sm text-red-600">
                        {{ $message }}
                    </span>
                @enderror

            </div>
        </div>
        <div class="grid  sm:grid-cols-2  md:grid-cols-2 gap-5 xl:grid-cols-2">

            <!-- Prenom -->
            <div class="mt-4">
                <x-input-label for="prenom" :value="__('Prenom')" />
                <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')"
                    autofocus autocomplete="prenom" />
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
            </div>

            <!-- Nom -->
            <div class="mt-4">
                <x-input-label for="nom" :value="__('Nom')" />
                <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                    autofocus autocomplete="nom" />
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>


            <!-- Telephone -->
            <div class="mt-4">
                <x-input-label for="tel" :value="__('Telephone')" />
                <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')"
                    autofocus autocomplete="tel" />
                <x-input-error :messages="$errors->get('tel')" class="mt-2" />
            </div>

            <!-- Genre -->
            <div class="mt-4">
                <x-input-label for="tel" :value="__('Genre')" />

                <select name="genre"
                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                    <option value="Fiminin">Fiminin</option>
                    <option value="Masculin">Masculin</option>
                </select>
                <x-input-error :messages="$errors->get('genre')" class="mt-2" />
            </div>

            <!-- Adresse -->
            <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')"
                    autofocus autocomplete="adresse" />
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div>

            <!-- Ville -->
            <div class="mt-4">
                <x-input-label for="ville" :value="__('Ville')" />
                <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')"
                    autofocus autocomplete="ville" />
                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
            </div>

            <!-- Pays -->
            <div class="mt-4">
                <x-input-label for="tel" :value="__('Pays')" />
                <x-text-input id="pays" class="block mt-1 w-full" type="text" name="pays" :value="old('pays')"
                    autofocus autocomplete="pays" />
                <x-input-error :messages="$errors->get('pays')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Vous avez un compte?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('S\'inscrir') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
