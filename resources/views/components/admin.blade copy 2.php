<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/fr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="font-sans antialiased bg-[#f5f5dc] ">
    <nav class="fixed top-0 z-50 w-full  border-b-2 border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 bg-[#c9ba46] lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('admin.index') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden p-4 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1 w-56" role="none">
                                <li>
                                    <a href="route('profile.edit')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Profil</a>
                                </li>


                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Se déconnecter') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.index') }}"
                        class="flex ms-3 @if (Route::is('admin.index')) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                        Tableau de bord
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.reservation.index') }}"
                        class="flex ms-3 @if (Route::is(['admin.reservation.index', 'admin.reservation.show'])) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                        Réservations
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.chambre.index') }}"
                        class="flex ms-3 @if (Route::is([
                                'admin.chambre.index',
                                'admin.chambre.create',
                                'admin.chambre.store',
                                'admin.reservation.edit',
                                'admin.reservation.update',
                            ])) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                        Chambres
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.salle.index') }}"
                        class="flex ms-3 @if (Route::is([
                                'admin.salle.index',
                                'admin.salle.create',
                                'admin.salle.store',
                                'admin.salle.edit',
                                'admin.salle.update',
                            ])) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                        Salles
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.client.index') }}"
                        class="flex ms-3 @if (Route::is([
                                'admin.client.index',
                                'admin.client.create',
                                'admin.client.store',
                                'admin.client.edit',
                                'admin.client.update',
                            ])) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                        Clients
                    </a>
                </li>

                @if (Auth::user()->role->role == 'admin')
                    <li>
                        <a href="{{ route('admin.service.index') }}"
                            class="flex ms-3 @if (Route::is([
                                    'admin.service.index',
                                    'admin.service.create',
                                    'admin.service.store',
                                    'admin.service.edit',
                                    'admin.service.update',
                                ])) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                            Services
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.categorie.index') }}"
                            class="flex ms-3 @if (Route::is([
                                    'admin.categorie.index',
                                    'admin.categorie.create',
                                    'admin.categorie.store',
                                    'admin.categorie.edit',
                                    'admin.categorie.update',
                                ])) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                            Categories
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.personnel.index') }}"
                            class="flex ms-3 @if (Route::is([
                                    'admin.personnel.index',
                                    'admin.personnel.create',
                                    'admin.personnel.store',
                                    'admin.personnel.edit',
                                    'admin.personnel.update',
                                ])) bg-[#c9ba46] text-[#352513] @else dark:hover:bg-gray-700 text-gray-900 @endif  items-center p-2   dark:text-white  hover:bg-[#c9ba46] hover:text-[#352513]  group">
                            Personnels
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            {{ $slot }}

        </div>
    </div>


</body>

</html>
