<nav x-data="{ open: false }" class=" bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('admin.index') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                <x-nav-link :href="route('admin.reservation.index')" :active="request()->routeIs([
                    'admin.reservation.index',
                    'admin.reservation.create',
                    'admin.reservation.edit',
                ])">
                    {{ __('Reservationes') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.equippement.index')" :active="request()->routeIs([
                    'admin.equippement.index',
                    'admin.equippement.create',
                    'admin.equippement.edit',
                ])">
                    {{ __('Reservationes') }}
                </x-nav-link>

                <x-nav-link :href="route('admin.chambre.index')" :active="request()->routeIs(['admin.chambre.index', 'admin.chambre.form'])">
                    {{ __('Chambres') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.client.index')" :active="request()->routeIs(['admin.client.index', 'admin.client.create', 'admin.client.edit'])">
                    {{ __('Client') }}
                </x-nav-link>

                <x-nav-link :href="route('admin.service.index')" :active="request()->routeIs(['admin.service.index', 'admin.service.form'])">
                    {{ __('Services') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.categorie.index')" :active="request()->routeIs(['admin.categorie.index', 'admin.categorie.form'])">
                    {{ __('Categories') }}
                </x-nav-link>

                <x-nav-link :href="route('admin.personnel.index')" :active="request()->routeIs([
                    'admin.personnel.index',
                    'admin.personnel.create',
                    'admin.personnel.edit',
                ])">
                    {{ __('Personnels') }}
                </x-nav-link>


            </div>

            <!-- Settings Dropdown -->
            <div class="flex sm:mr-2">
                <div class=" my-auto sm:mr-3 items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                @auth
                                    <div>{{ Auth::user()->nom }}</div>
                                @endauth
                                @guest
                                    User
                                @endguest

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @auth
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
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
            {{-- <x-responsive-nav-link :href="route('admin.reservation.index')" :active="request()->routeIs([
                    'admin.reservation.index',
                    'admin.reservation.create',
                    'admin.reservation.edit',
                ])">
                    {{ __('Reservationes') }}
                </x-responsive-nav-link> --}}
            <x-responsive-nav-link :href="route('admin.chambre.index')" :active="request()->routeIs(['admin.chambre.index', 'admin.chambre.form'])">
                {{ __('Chambres') }}
            </x-responsive-nav-link>
            <x-nav-link :href="route('admin.client.index')" :active="request()->routeIs(['admin.client.index', 'admin.client.create', 'admin.client.edit'])">
                {{ __('Client') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.service.index')" :active="request()->routeIs(['admin.service.index', 'admin.service.form'])">
                    {{ __('Services') }}
            </x-nav-link>
            <x-responsive-nav-link :href="route('admin.categorie.index')" :active="request()->routeIs(['admin.categorie.index', 'admin.categorie.form'])">
                {{ __('Categories') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.personnel.index')" :active="request()->routeIs(['admin.personnel.index', 'admin.personnel.create', 'admin.personnel.edit'])">
                {{ __('Personnels') }}
            </x-responsive-nav-link>




            {{-- </x-responsive-nav-link> --}}

        </div>
    </div>
</nav>
