<x-guest-layout>
    <section class="courses-section container mx-auto px-4 py-8 font-sans">
        <h1 class="text-3xl font-bold text-green-600 text-center">Gérer les Cours</h1>
        <form method="POST" action="{{ route('courses.store') }}" class="max-w-xl mx-auto mt-6 space-y-4">
            @csrf
            <div class="mb-4">
                <label for="title" class="block font-bold">Titre du cours :</label>
                <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded p-2">
            </div>
            <div class="mb-4">
                <label for="description" class="block font-bold">Description :</label>
                <textarea id="description" name="description" class="w-full border border-gray-300 rounded p-2"></textarea>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                <i class="fas fa-plus"></i> Ajouter le cours
            </button>
        </form>

        <!-- Search -->
        <div class="mt-8 max-w-xl mx-auto">
            <form method="GET" action="{{ route('courses.index') }}" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un cours..."
                    class="w-full border border-gray-300 rounded p-2" />
                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    <i class="fas fa-search"></i> Rechercher
                </button>
            </form>
        </div>

        <h2 class="text-2xl font-semibold text-green-600 mt-8 text-center">Liste des cours</h2>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach ($courses as $course)
                <li class="bg-white shadow rounded p-4 flex flex-col justify-between">
                    <h3 class="text-xl font-bold text-gray-800">{{ $course->title }}</h3>
                    <p class="text-gray-600 mt-2">{{ $course->description }}</p>
                    <form method="POST" action="{{ route('courses.destroy', $course->id) }}" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce cours?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            <i class="fas fa-trash-alt"></i> Supprimer
                        </button>
                    </form>
                    <a href="{{ route('courses.edit', $course->id) }}" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded inline-flex items-center">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="mt-6">
            {{ $courses->withQueryString()->links() }}
        </div>
    </section>
    <footer class="bg-gray-100 py-4 mt-8 text-center text-gray-600">
        <p>&copy; 2025 Plateforme de Formation. Tous droits réservés.</p>
    </footer>
</x-guest-layout>
