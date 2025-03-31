<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-gray-400 opacity-50 lg:hidden"></div>
<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-800 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <span class="mx-2 text-2xl font-semibold text-white">BAOL HOTEL</span>
        </div>
    </div>

    <nav class="mt-6">


        <x-responsive-nav-link class="mb-2 " :href="route('admin.index')" :active="request()->routeIs('admin.index')">
            {{ __('Tableau de bord') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('admin.reservation.index')" :active="request()->routeIs([
            'admin.reservation.index',
            'admin.reservation.create',
            // 'admin.reservation.edit',
        ])">
            {{ __('Reservations') }}
        </x-responsive-nav-link>


        <x-responsive-nav-link :href="route('admin.chambre.index')" :active="request()->routeIs(['admin.chambre.index', 'admin.chambre.create', 'admin.chambre.edit'])">
            {{ __('Chambres') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('admin.salle.index')" :active="request()->routeIs(['admin.salle.index', 'admin.salle.create', 'admin.salle.edit'])">
            {{ __('Salles') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('admin.client.index')" :active="request()->routeIs(['admin.client.index', 'admin.client.create', 'admin.client.edit'])">
            {{ __('Client') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('admin.service.index')" :active="request()->routeIs(['admin.service.index', 'admin.service.form'])">
            {{ __('Services') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('admin.categorie.index')" :active="request()->routeIs(['admin.categorie.index', 'admin.categorie.form'])">
            {{ __('Categories') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('admin.personnel.index')" :active="request()->routeIs(['admin.personnel.index', 'admin.personnel.create', 'admin.personnel.edit'])">
            {{ __('Personnels') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('admin.equippement.index')" :active="request()->routeIs([
            'admin.equippement.index',
            'admin.equippement.create',
            'admin.equippement.edit',
        ])">
            {{ __('Equippement') }}
        </x-responsive-nav-link>

    </nav>
</div>
