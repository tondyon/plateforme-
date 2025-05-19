<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-100 border-r min-h-screen flex flex-col">
        <div class="h-16 flex items-center px-6 border-b">
            <div class="flex items-center space-x-3">
    <img src="/images/logo.jpeg" alt="Plateforme Logo" class="h-12 w-12 rounded-full border-2 border-blue-500 shadow bg-white object-cover">
    <span class="text-2xl font-bold text-blue-700 hidden sm:inline">Plateforme</span>
</div>
        </div>
        <nav class="flex-1 flex flex-col py-8 px-4 space-y-4 text-gray-700 text-lg">
    <a href="{{ route('dashboard') }}" class="hover:text-blue-700">Dashboard</a>
    <a href="{{ route('about') }}" class="hover:text-blue-700">À propos</a>
    <a href="{{ route('services') }}" class="hover:text-blue-700">Services</a>
    <a href="{{ route('contact.index') }}" class="hover:text-blue-700">Contact</a>
    <a href="{{ route('profile.edit') }}" class="hover:text-blue-700">Profil / Paramètres</a>
    <a href="{{ route('courses.index') }}" class="hover:text-blue-700">Cours</a>
    <a href="{{ route('formateur.meetings.index') }}" class="hover:text-blue-700">Réunions</a>
    <a href="{{ route('formateur.courses.index') }}" class="hover:text-blue-700">Espace Formateur</a>
    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-700">Admin</a>
    {{-- Si "Réunion" est une route différente de "Réunions", ajoute-la ici : --}}
    {{-- <a href="{{ route('reunion.unique') }}" class="hover:text-blue-700">Réunion</a> --}}
</nav>
    </aside>
    <!-- Main Content (injecté ici !) -->
    <div class="flex-1 min-h-screen">
        @yield('content')
    </div>
</div>

