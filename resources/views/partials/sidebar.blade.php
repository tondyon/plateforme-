<div class="w-64 bg-white shadow p-4 h-full">
    <nav class="space-y-2">
        <a href="{{ url('/') }}" class="block px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Accueil</a>
        @can('formateur')
            <a href="{{ route('formateur.dashboard') }}" class="block px-3 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Dashboard Formateur</a>
            <a href="{{ route('formateur.courses.index') }}" class="block px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">Mes Cours</a>
            <a href="{{ route('formateur.courses.create') }}" class="block px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600">Créer Cours</a>
        @endcan
        <a href="{{ route('courses.index') }}" class="block px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">Cours</a>
        <a href="{{ route('about') }}" class="block px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">À propos</a>
        <a href="{{ route('contact.index') }}" class="block px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Contact</a>
        <a href="{{ route('formateur.meetings.index') }}" class="block px-3 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Réunions</a>
        <a href="{{ route('formateur.meetings.create') }}" class="block px-3 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Créer Réunion</a>
        <a href="{{ route('formateur.direct') }}" class="block px-3 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Direct</a>
        @guest
            <a href="{{ route('login') }}" class="block px-3 py-2 bg-teal-500 text-white rounded hover:bg-teal-600">Se connecter</a>
            <a href="{{ route('register') }}" class="block px-3 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">S'inscrire</a>
        @else
            <div class="border-t my-2"></div>
            <span class="block px-3 py-2 text-gray-700">Bonjour, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                @csrf
                <button class="w-full text-left text-gray-700 hover:bg-gray-100 px-3 py-2 rounded">Déconnexion</button>
            </form>
        @endguest
    </nav>
</div>
