<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institut des Savoirs Numériques</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Styles Tailwind personnalisés -->
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fadeIn 0.2s ease-in;
        }

        /* Transition pour le menu mobile */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class  = "bg-gray-50">
<nav  x-data = "{ open: false, explorerOpen: false }"
      class  = "bg-white border-b border-gray-200 fixed top-0 left-0 w-full z-50 shadow-md"
         x-cloak>

        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
            <!-- Logo + Menu mobile -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <img src="/images/logo.jpeg" alt="Plateforme Logo" class="h-8 w-8 object-cover rounded">
                    <span class="text-xl md:text-2xl font-bold text-blue-700">Institut des Savoirs Numériques</span>
                </div>

                <!-- Bouton menu mobile -->
                <button @click="open = !open" class="md:hidden focus:outline-none">
                    <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Menu desktop -->
            <div class="hidden md:flex items-center gap-4">
                <!-- Menu Explorer -->
                <div class="relative" @mouseenter="explorerOpen = true" @mouseleave="explorerOpen = false">
                    <button @click="explorerOpen = !explorerOpen"
                            class="flex items-center gap-1 px-3 py-1 rounded bg-blue-50 font-semibold text-blue-800 hover:bg-blue-100 transition-colors">
                        Explorer
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': explorerOpen }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Mega Menu -->
                    <div x-show="explorerOpen" x-transition
                         class="absolute left-0 mt-2 w-full max-w-5xl bg-white border border-gray-200 shadow-xl rounded-xl z-50 p-6 grid grid-cols-2 lg:grid-cols-4 gap-6"
                         @click.away="explorerOpen = false">

                        <!-- Colonne 1 - Rôles -->
                        <div>
                            <h4 class="font-bold mb-3 text-blue-700 flex items-center gap-2">
                                <i class="fas fa-user-tie text-blue-500"></i> Rôles
                            </h4>
                            <ul class="space-y-2">
                                <!-- Liste des rôles avec liens valides -->
                                <li>
                                    <a href="{{ route('roles.show', ['role' => 'analyste-donnees']) }}"
                                       class="flex items-center gap-2 px-2 py-1 rounded hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors">
                                        <i class="fas fa-chart-line text-blue-400 w-4"></i>
                                        Analyste de données
                                    </a>
                                </li>
                                <!-- ... autres rôles ... -->
                            </ul>
                            <a href="{{ route('roles.index') }}" class="mt-2 text-sm text-blue-600 hover:underline inline-block">
                                Voir tous les rôles →
                            </a>
                        </div>

                        <!-- Colonne 2 - Catégories -->
                        <div>
                            <h4 class="font-bold mb-3 text-green-700 flex items-center gap-2">
                                <i class="fas fa-layer-group text-green-500"></i> Catégories
                            </h4>
                            <ul class="space-y-2">
                                <li>
                                    <a href="/categorie/business" class="block px-2 py-1 rounded hover:bg-green-50 text-gray-700 hover:text-green-700">
                                        Business
                                    </a>
                                </li>
                                <!-- ... autres catégories ... -->
                            </ul>
                        </div>

                        <!-- Colonne 3 - Formations -->
                        <div>
                            <h4 class="font-bold mb-3 text-purple-700 flex items-center gap-2">
                                <i class="fas fa-certificate text-purple-500"></i> Certifications
                            </h4>
                            <!-- ... contenu ... -->
                        </div>

                        <!-- Colonne 4 - Compétences -->
                        <div>
                            <h4 class="font-bold mb-3 text-orange-700 flex items-center gap-2">
                                <i class="fas fa-bolt text-orange-500"></i> Compétences
                            </h4>
                            <!-- ... contenu ... -->
                        </div>
                    </div>
                </div>

                <!-- Autres liens navigation -->
                <nav class="flex items-center gap-4 ml-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors">
                        Accueil
                    </a>
                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors">
                        Mon apprentissage
                    </a>
                    <a href="{{ route('certifications.diplomes.index') }}" class="text-gray-700 hover:text-blue-700 font-medium transition-colors">
                        Diplômes
                    </a>

                    <!-- Menu déroulant Formateur -->
                    <div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="text-gray-700 hover:text-blue-700 font-medium transition-colors flex items-center gap-1 focus:outline-none">
        Formateur <i class="fas fa-chevron-down text-xs" :class="{ 'rotate-180': open }"></i>
    </button>
    <div x-show="open" @click.away="open = false" x-transition
         class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg z-50 py-2">
        <a href="{{ route('formateur.meetings.index') }}" class="block px-4 py-2 hover:bg-blue-50">Réunion</a>
        <a href="{{ route('formateur.directs.index') }}" class="block px-4 py-2 hover:bg-blue-50">Direct</a>
        <a href="{{ route('formateur.courses.files.index') }}" class="block px-4 py-2 hover:bg-blue-50">Fichiers de cours</a>
    </div>
</div>
                </nav>
            </div>

            <!-- Partie droite (recherche + icônes) -->
            <div class="flex items-center gap-4">
                <!-- Barre de recherche (visible desktop) -->
                <form class="hidden md:block w-64" action="{{ route('courses.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="q"
                               class="w-full border rounded-full px-4 py-2 pl-10 focus:outline-blue-400 bg-gray-50 text-sm"
                               placeholder="Rechercher des cours...">
                        <button type="submit" class="absolute left-3 top-2.5 text-blue-700">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Icônes -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('cart') }}" class="relative text-gray-600 hover:text-blue-700">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">1</span>
                    </a>

                    <div class="relative" x-data="{ langOpen: false }">
                        <button @click="langOpen = !langOpen"
                                class="flex items-center gap-1 text-gray-600 hover:text-blue-700">
                            <i class="fas fa-globe"></i>
                            <span class="text-sm">FR</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': langOpen }"></i>
                        </button>

                        <div x-show="langOpen" @click.away="langOpen = false"
                             class="absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg z-50 py-1">
                            <a href="#" class="block px-4 py-2 hover:bg-blue-50 text-sm">Français</a>
                            <a href="#" class="block px-4 py-2 hover:bg-blue-50 text-sm">English</a>
                        </div>
                    </div>

                    <a href="{{ route('notifications') }}" class="text-gray-600 hover:text-blue-700">
                        <i class="fas fa-bell text-lg"></i>
                    </a>

                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen"
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-900 text-white font-bold">
                            T
                        </button>

                        <div x-show="profileOpen" @click.away="profileOpen = false"
                             class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50 py-1">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-blue-50">Mon profil</a>
                            <a href="{{ route('settings') }}" class="block px-4 py-2 hover:bg-blue-50">Paramètres</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-blue-50 text-red-600">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div x-show="open" x-transition
             class="md:hidden bg-white border-t shadow-lg">
            <div class="px-4 py-3 space-y-4">
                <!-- Barre de recherche mobile -->
                <form action="{{ route('courses.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="q"
                               class="w-full border rounded-full px-4 py-2 pl-10 focus:outline-blue-400 bg-gray-50 text-sm"
                               placeholder="Rechercher des cours...">
                        <button type="submit" class="absolute left-3 top-2.5 text-blue-700">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Liens principaux -->
                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="block px-2 py-1 font-medium text-gray-700 hover:text-blue-700">
                        Accueil
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block px-2 py-1 font-medium text-gray-700 hover:text-blue-700">
                        Mon apprentissage
                    </a>
                    <a href="{{ route('certifications.diplomes.index') }}" class="block px-2 py-1 font-medium text-gray-700 hover:text-blue-700">
                        Diplômes en ligne
                    </a>
                </div>

                <!-- Sous-menu Explorer -->
                <div x-data="{ mobileExplorerOpen: false }" class="border-t pt-2 mt-2">
                    <button @click="mobileExplorerOpen = !mobileExplorerOpen"
                            class="flex items-center justify-between w-full px-2 py-1 font-medium text-gray-700">
                        <span>Explorer</span>
                        <i class="fas fa-chevron-down text-xs transition-transform"
                           :class="{ 'rotate-180': mobileExplorerOpen }"></i>
                    </button>

                    <div x-show = "mobileExplorerOpen" class         = "pl-4 mt-2 space-y-2">
                    <a href = "{{ route('roles.index') }}" class = "block px-2 py-1 text-sm text-gray-600 hover:text-blue-700">
                            Par rôles
                        </a>
                        <a href="{{ route('categories.index') }}" class="block px-2 py-1 text-sm text-gray-600 hover:text-blue-700">
                            Par catégories
                        </a>
                        <a href="{{ route('certifications.index') }}" class="block px-2 py-1 text-sm text-gray-600 hover:text-blue-700">
                            Certifications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="pt-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-6">
            @yield('content')
        </div>
    </main>
</body>
</html>
