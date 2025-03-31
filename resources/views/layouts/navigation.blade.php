<nav x-data="{ open: false }" style="position:fixed" class=" w-full bg-white border-b-2 border-[#806328]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                
                <a href="{{ route('acceuil') }}" class="text-xl text-black font-bold">
                    BAOL <spam class="text-xl text-[#baa538]">HOTEL</spam>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-2  sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('acceuil')" :active="request()->routeIs([
                    'acceuil',
                    'show.detaille',
                    'reservation.verification',
                    'reservation.create',
                    'reservation.createClient',
                    'reservation.payerReservation',
                    'reservation.loginForm',
                    'reservation.login',
                    'reservation.retour',
                    'reservation.retour',
                    'create.payment',
                    'make.payment',
                    'cancel.payment',
                ])">
                    {{ __('Accueil') }}
                </x-nav-link>
                <x-nav-link :href="route('categorie')" :active="request()->routeIs('categorie')">
                    {{ __('Categorie') }}
                </x-nav-link>
                <x-nav-link :href="route('service')" :active="request()->routeIs('service')">
                    {{ __('Service') }}
                </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    {{ __('A propos') }}
                </x-nav-link>
                @auth
                    @if (Auth::user()->role->role == 'client')
                        <x-nav-link :href="route('reservation')" :active="request()->routeIs(['reservation', 'user.facture.show', 'reservation.show'])">
                            {{ __('Mes reservations') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role->role == 'admin' || Auth::user()->role->role == 'receptionniste')
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                            {{ __('Tableau de bord') }}
                        </x-nav-link>
                    @endif
                @endauth



            </div>

            <!-- Settings Dropdown -->

            <div class="flex sm:mr-2">
                <div class=" my-auto sm:mr-3 items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3  text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                @auth
                                    <div>{{ Auth::user()->prenom }}</div>
                                @endauth
                                <div class="ml-3">

                                    @guest
                                        <div class="w-10 h-10 ">
                                            <img src="{{ asset('bh/user.jpeg') }}" class="w-full h-full rounded-full" />
                                        </div>
                                    @endguest
                                    @auth
                                        <div class="w-10 h-10 ">
                                            <img src="{{ asset(Auth::user()->image) }}" class="w-full h-full rounded-full" />
                                        </div>
                                    @endauth

                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @auth
                                @if (Auth::user()->role->role == 'client')
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                @endif


                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </x-dropdown-link>
                                </form>
                            @endauth
                            @guest
                                <x-dropdown-link :href="route('login')">
                                    {{ __('Se connecter') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('register')">
                                    {{ __('S\'inscrire') }}
                                </x-dropdown-link>
                            @endguest

                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('acceuil')" :active="request()->routeIs('acceuil')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categorie')" :active="request()->routeIs('categorie')">
                {{ __('Categorie') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('service')" :active="request()->routeIs('service')">
                {{ __('Service') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('A propos') }}
            </x-responsive-nav-link>
            @auth
                @if (Auth::user()->role->role == 'client' || Auth::user()->role->role == 'receptionniste')
                    <x-responsive-nav-link :href="route('reservation')" :active="request()->routeIs(['reservation', 'user.facture.show', 'reservation.show'])">
                        {{ __('Mes reservations') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role->role == 'admin' || Auth::user()->role->role == 'receptionniste')
                    <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                        {{ __('Tableau de bord') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

    </div>
</nav>
