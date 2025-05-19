@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Mes cours</h1>

        <!-- Filtres -->
        <div class="flex items-center space-x-4">
            <select id="courseFilter" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="all">Tous les cours</option>
                <option value="in-progress">En cours</option>
                <option value="completed">Terminés</option>
            </select>

            <select id="sortOrder" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="recent">Plus récents</option>
                <option value="progress">Progression</option>
                <option value="name">Nom</option>
            </select>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progression</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscrit le</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($courses as $course)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="{{ $course->image ?? asset('images/course-default.jpg') }}"
                                     alt="{{ $course->title }}"
                                     class="h-10 w-10 rounded-full object-cover mr-3">
                                <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php $progress = $course->pivot->progress ?? 0; @endphp
                            <div class="relative pt-1">
                                <div class="flex mb-2 items-center justify-between">
                                    <div>
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ $progress == 100 ? 'text-green-600 bg-green-200' : 'text-blue-600 bg-blue-200' }}">
                                            {{ $progress }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="flex h-2 mb-4 overflow-hidden bg-gray-200 rounded">
                                    <div class="transition-all duration-500 {{ $progress == 100 ? 'bg-green-500' : 'bg-blue-500' }}"
                                         style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $course->pivot->enrolled_at ? $course->pivot->enrolled_at->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($progress == 100)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Terminé
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    En cours
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex justify-end space-x-3">
                                @if($progress == 100)
                                    <a href="{{ route('courses.show', $course) }}"
                                       class="text-green-600 hover:text-green-900">
                                        Revoir
                                    </a>
                                @else
                                    <a href="{{ route('courses.show', $course) }}"
                                       class="text-blue-600 hover:text-blue-900">
                                        Continuer
                                    </a>
                                @endif

                                <button onclick="openCertificateModal({{ $course->id }})"
                                        {{ $progress < 100 ? 'disabled' : '' }}
                                        class="text-indigo-600 hover:text-indigo-900 {{ $progress < 100 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                    Certificat
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal pour le certificat -->
<div x-data="{ showCertificateModal: false, courseId: null }"
     x-show="showCertificateModal"
     class="fixed inset-0 overflow-y-auto"
     style="display: none;">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    Télécharger le certificat
                </h3>
                <p class="text-sm text-gray-500">
                    Félicitations ! Vous pouvez maintenant télécharger votre certificat de réussite.
                </p>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="window.location.href = `/courses/${courseId}/certificate`"
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Télécharger
                </button>
                <button @click="showCertificateModal = false"
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openCertificateModal(courseId) {
        window.__x.$data.showCertificateModal = true;
        window.__x.$data.courseId = courseId;
    }

    // Filtrage des cours
    document.getElementById('courseFilter').addEventListener('change', function() {
        const rows = document.querySelectorAll('tbody tr');
        const filter = this.value;

        rows.forEach(row => {
            const progress = parseInt(row.querySelector('.text-xs.font-semibold').textContent);

            switch(filter) {
                case 'completed':
                    row.style.display = progress === 100 ? '' : 'none';
                    break;
                case 'in-progress':
                    row.style.display = progress < 100 ? '' : 'none';
                    break;
                default:
                    row.style.display = '';
            }
        });
    });

    // Tri des cours
    document.getElementById('sortOrder').addEventListener('change', function() {
        const tbody = document.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const sortBy = this.value;

        rows.sort((a, b) => {
            switch(sortBy) {
                case 'progress':
                    const progressA = parseInt(a.querySelector('.text-xs.font-semibold').textContent);
                    const progressB = parseInt(b.querySelector('.text-xs.font-semibold').textContent);
                    return progressB - progressA;
                case 'name':
                    const nameA = a.querySelector('.text-sm.font-medium').textContent;
                    const nameB = b.querySelector('.text-sm.font-medium').textContent;
                    return nameA.localeCompare(nameB);
                case 'recent':
                    const dateA = a.querySelectorAll('td')[2].textContent;
                    const dateB = b.querySelectorAll('td')[2].textContent;
                    return new Date(dateB) - new Date(dateA);
            }
        });

        rows.forEach(row => tbody.appendChild(row));
    });
</script>
@endpush
@endsection
