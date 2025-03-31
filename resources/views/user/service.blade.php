<x-app-layout>

    @section('titre', 'Nos service')

    <div class="py-8">
    </div>



    <div class="bg-cover  text-white pt-16  object-fill" style="background-image: url({{ asset('image/gallery.jpg') }}">
        <h1 class="py-4 text-center text-md md:text-2xl font-bold">
            NOS <span class="text-[#baa538] text-uppercase">
                SERVICES </span>
            <h1>
    </div>
    <div
        class="font-sans max-w-5xl p-4 mt-6 items-center text-center gap-4 mx-auto grid  grid-cols-1 sm:grid-cols-2 md:grid-cols-3  items-top space-y-4">

        <div class="flex items-start flex-wrap">
            <div class="w-20 h-20 mx-auto">
                <img src="{{ asset('icons/hébergement.png') }}">
            </div>
            <div class="mt-6 h-full">
                <p class="font-semibold">Hébergement</p>
                <p class="text-gray-600">Profitez d'un séjour confortable dans nos chambres spacieuses et bien
                    équipées. Choisissez parmi une variété de chambres simples, doubles, famidivales ou suites.
                </p>
            </div>
        </div>

        <div class="flex items-start flex-wrap">
            <div class="w-20 h-20 mx-auto">
                <img src="{{ asset('icons/restauration.png') }}">
            </div>
            <div class="mt-6 h-full">
                <p class="font-semibold">Restauration</p>
                <p class="text-gray-600">Découvrez une dédivcieuse cuisine préparée par nos chefs talentueux. Nos
                    restaurants proposent une variété de plats pour le petit-déjeuner, le déjeuner et le dîner,
                    ainsi que des options de service en chambre.
                </p>
            </div>
        </div>

        <div class="flex items-start flex-wrap">
            <div class="w-20 h-20 mx-auto">
                <img src="{{ asset('icons/equipements.png') }}">
            </div>
            <div class="mt-6 h-full">
                <p class="font-semibold">Équipements</p>
                <p class="text-gray-600">Profitez de nos équipements modernes pour rendre votre séjour plus
                    agréable. Nous offrons une piscine rafraîchissante, un centre de remise en forme entièrement
                    équipé et d'autres installations de loisirs pour votre plaisir.
                </p>
            </div>
        </div>

        <div class="flex items-start flex-wrap">
            <div class="w-20 h-20 mx-auto">
                <img src="{{ asset('icons/divertissement.png') }}">
            </div>
            <div class="mt-6 h-full">
                <p class="font-semibold">Divertissement</p>
                <p class="text-gray-600">Amusez-vous avec nos activités de divertissement excitantes. Nous proposons
                    des soirées à thème, des spectacles en direct et d'autres événements pour divertir toute la
                    famille.
                </p>
            </div>
        </div>

        <div class="flex items-start flex-wrap">
            <div class="w-20 h-20 mx-auto">
                <img src="{{ asset('icons/auto.png') }}">
            </div>
            <div class="mt-6 h-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Service de Voiturier</h3>
                <p class="text-gray-600">Confiez-nous votre véhicule pour un stationnement pratique et sécurisé. Notre
                    équipe de voituriers expérimentés vous garantit un service rapide et efficace.
                </p>
            </div>
        </div>

        <div class="flex items-start flex-wrap">
            <div class="w-20 h-20 mx-auto"><svg class="w-full h-full text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                        clip-rule="evenodd" />
                </svg>

            </div>
            <div class="mt-6 h-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Service de Location de Voitures</h3>
                <p class="text-gray-600">Explorez la région à votre rythme avec notre service de location de
                    voitures. Nous
                    proposons une large gamme de véhicules de qualité pour répondre à tous vos besoins de
                    déplacement.</p>

            </div>

        </div>
    </div>

</x-app-layout>
