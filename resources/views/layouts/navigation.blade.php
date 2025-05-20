<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<nav x-data="{ open: false, explorerOpen: false }" class="bg-white border-b border-gray-200 fixed top-0 left-0 w-full z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
        <!-- Logo et nom du site -->
        <div class="flex items-center gap-2">
            <img src="/images/logo.jpeg" alt="Plateforme Logo" class="h-8 w-8 object-cover">
            <span class="text-2xl font-bold text-blue-700">COURSE<span class="text-black">VIA</span></span>
            <!-- Menu hamburger mobile -->
            <button @click="open = !open" class="md:hidden ml-4 focus:outline-none">
                <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <!-- Menu desktop -->
        <div class="hidden md:flex items-center gap-2 ml-8">
            <div class="relative" @mouseenter="explorerOpen = true" @mouseleave="explorerOpen = false">
    <button @click="explorerOpen = !explorerOpen" class="flex items-center border px-3 py-1 rounded bg-blue-50 font-semibold text-blue-800 hover:bg-blue-100">
        Explorer
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
    </button>
    <!-- Mega menu Explorer -->
    <div x-show="explorerOpen" x-transition
     class="absolute left-0 mt-2 w-full max-w-5xl bg-white border border-gray-200 shadow-2xl rounded-2xl z-50 p-8 flex flex-col md:flex-row gap-8 md:gap-10 animate-fade-in"
     style="display: none; min-width: 320px;">
    <!-- Colonne 1 : Explorer les rôles -->
    <div class="flex-1 min-w-[180px]">
        <h4 class="font-bold mb-3 text-blue-700 flex items-center gap-2"><i class="fa-solid fa-user-tie"></i> Rôles</h4>
        <ul class="space-y-1 text-sm">
            <li><a href="{{ route('roles.show', ['role' => 'analyste-donnees']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-chart-line text-blue-400"></i>Analyste de données</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'gestionnaire-projet']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-diagram-project text-blue-400"></i>Gestionnaire de projet</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'analyste-cybersecurite']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-shield-halved text-blue-400"></i>Analyste en cybersécurité</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'scientifique-donnees']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-flask text-blue-400"></i>Scientifique des données</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'marketing-numerique']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-bullhorn text-blue-400"></i>Spécialiste marketing numérique</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'ui-ux']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-pencil-ruler text-blue-400"></i>Concepteur UI/UX</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'ingenieur-ia']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-brain text-blue-400"></i>Ingénieur en apprentissage automatique</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'reseaux-sociaux']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-network-wired text-blue-400"></i>Spécialiste réseaux sociaux</a></li>
            <li><a href="{{ route('roles.show', ['role' => 'support-informatique']) }}" class="rounded px-2 py-1 hover:bg-blue-50 cursor-pointer flex items-center gap-2"><i class="fa-solid fa-headset text-blue-400"></i>Spécialiste support informatique</a></li>
            <li><a href="#" class="text-blue-600 hover:underline text-xs">Voir tout</a></li>
        </ul>
    </div>
    <!-- Colonne 2 : Catégories -->
    <div class="flex-1 min-w-[180px]">
        <h4 class="font-bold mb-3 text-green-700 flex items-center gap-2"><i class="fa-solid fa-layer-group"></i> Catégories</h4>
        <ul class="space-y-1 text-sm">
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Business</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Science des données</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Technologies de l'information</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Informatique</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Sciences de la vie</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Sciences physiques et ingénierie</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Développement personnel</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Sciences sociales</li>
            <li class="rounded px-2 py-1 hover:bg-green-50 cursor-pointer">Langues</li>
            <li><a href="#" class="text-green-600 hover:underline text-xs">Voir tout</a></li>
        </ul>
    </div>
    <!-- Colonne 3 : Certificats et diplômes -->
    <div class="flex-1 min-w-[180px]">
        <h4 class="font-bold mb-3 text-purple-700 flex items-center gap-2"><i class="fa-solid fa-certificate"></i> Certificats</h4>
        <ul class="space-y-1 text-sm">
            <li class="rounded px-2 py-1 hover:bg-purple-50 cursor-pointer">Business</li>
            <li class="rounded px-2 py-1 hover:bg-purple-50 cursor-pointer">Informatique</li>
            <li class="rounded px-2 py-1 hover:bg-purple-50 cursor-pointer">Science des données</li>
            <li class="rounded px-2 py-1 hover:bg-purple-50 cursor-pointer">Technologies de l'information</li>
            <li><a href="#" class="text-purple-600 hover:underline text-xs">Voir tout</a></li>
        </ul>
        <h4 class="font-bold mt-6 mb-3 text-indigo-700 flex items-center gap-2"><i class="fa-solid fa-graduation-cap"></i> Diplômes en ligne</h4>
        <ul class="space-y-1 text-sm">
            <li class="rounded px-2 py-1 hover:bg-indigo-50 cursor-pointer">Licences</li>
            <li class="rounded px-2 py-1 hover:bg-indigo-50 cursor-pointer">Masters</li>
            <li class="rounded px-2 py-1 hover:bg-indigo-50 cursor-pointer">Programmes de troisième cycle</li>
        </ul>
    </div>
    <!-- Colonne 4 : Compétences tendance -->
    <div class="flex-1 min-w-[180px]">
        <h4 class="font-bold mb-3 text-orange-700 flex items-center gap-2"><i class="fa-solid fa-bolt"></i> Compétences tendance</h4>
        <ul class="space-y-1 text-sm">
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">Python</li>
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">Intelligence artificielle</li>
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">Excel</li>
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">Apprentissage automatique</li>
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">SQL</li>
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">Gestion de projet</li>
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">Power BI</li>
            <li class="rounded px-2 py-1 hover:bg-orange-50 cursor-pointer">Marketing</li>
        </ul>
        <h4 class="font-bold mt-6 mb-3 text-orange-700 flex items-center gap-2"><i class="fa-solid fa-certificate"></i> Préparer un examen</h4>
        <ul class="space-y-1 text-sm">
            <li><a href="#" class="text-orange-600 hover:underline text-xs">Voir tout</a></li>
        </ul>
    </div>
</div>
</div>
            <a href="{{ route('dashboard') }}" class="font-semibold text-blue-800 hover:underline ml-4">Page d'accueil</a>
            <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-blue-700 ml-4">Mon apprentissage</a>
            <a href="#" class="text-gray-700 hover:text-blue-700 ml-4">Diplômes en ligne</a>
            <a href="#" class="text-gray-700 hover:text-blue-700 ml-4">Carrières</a>
            <a href="{{ route('apropos') }}" class="text-gray-700 hover:text-blue-700 ml-4 {{ request()->routeIs('apropos') ? 'font-bold border-b-2 border-blue-700' : '' }}">À propos</a>
        </div>
    </div>
    <!-- Barre de recherche -->
    <form class="flex-1 mx-4 max-w-lg hidden md:block" action="{{ route('courses.index') }}" method="GET">
        <div class="relative">
            <input type="text" name="q" class="w-full border rounded-full px-4 py-2 pl-10 focus:outline-blue-400 bg-gray-50" placeholder="Que souhaitez-vous apprendre ?">
            <button type="submit" class="absolute left-2 top-1.5 text-blue-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" fill="none"/><path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" fill="none"/></svg>
            </button>
        </div>
    </form>
    <!-- Icônes à droite -->
    <div class="flex items-center gap-4">
        <a href="#" class="relative">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full px-1">1</span>
        </a>
        <div class="relative">
            <button class="flex items-center gap-1 text-gray-600 hover:text-blue-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12a10 10 0 0020 0"/></svg>
                Français
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
        </div>
        <a href="#" class="relative">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </a>
        <div class="relative">
            <button class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-900 text-white font-bold">T</button>
            <svg class="w-4 h-4 absolute right-0 bottom-0 bg-white rounded-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </div>
    </div>
    <!-- Menu mobile -->
    <div x-show="open" x-transition class="absolute left-0 top-full w-full bg-white border-b shadow-md md:hidden z-50">
        <div class="flex flex-col gap-2 px-6 py-4">
            <div class="relative mb-2">
                <button @click="explorerOpen = !explorerOpen" class="flex items-center border px-3 py-1 rounded bg-blue-50 font-semibold text-blue-800 hover:bg-blue-100 w-full">
                    Explorer
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="explorerOpen" x-transition class="mt-2 w-full bg-white border rounded shadow-lg z-20">
                    <a href="#" class="block px-4 py-2 hover:bg-blue-50">Informatique</a>
                    <a href="#" class="block px-4 py-2 hover:bg-blue-50">Business</a>
                    <a href="#" class="block px-4 py-2 hover:bg-blue-50">Langues</a>
                    <a href="#" class="block px-4 py-2 hover:bg-blue-50">Développement personnel</a>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="font-semibold text-blue-800 hover:underline">Page d'accueil</a>
            <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-blue-700">Mon apprentissage</a>
            <a href="#" class="text-gray-700 hover:text-blue-700">Diplômes en ligne</a>
            <a href="#" class="text-gray-700 hover:text-blue-700">Carrières</a>
            <form class="mt-2" action="{{ route('courses.index') }}" method="GET">
                <div class="relative">
                    <input type="text" name="q" class="w-full border rounded-full px-4 py-2 pl-10 focus:outline-blue-400 bg-gray-50" placeholder="Que souhaitez-vous apprendre ?">
                    <button type="submit" class="absolute left-2 top-1.5 text-blue-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" fill="none"/><path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</nav>
<div class="max-w-7xl mx-auto px-4">
    @yield('content')
</div>

