<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3">
        <h1 class="text-2xl font-bold">Gestion des cours</h1>
        <div class="flex gap-2">
            <input wire:model.debounce.400ms="search" type="text" placeholder="Rechercher..." class="border rounded px-3 py-2 text-sm" />
            <button wire:click="showAddForm" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ajouter un cours</button>
        </div>
    </div>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left p-3">ID</th>
                <th class="text-left p-3">Titre</th>
                <th class="text-left p-3">Description</th>
                <th class="text-left p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cours as $c)
            <tr class="border-t">
                <td class="p-3">{{ $c->id }}</td>
                <td class="p-3">{{ $c->title }}</td>
                <td class="p-3">{{ $c->description }}</td>
                <td class="p-3 flex gap-2">
                    <button wire:click="showEditForm({{ $c->id }})" class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">Éditer</button>
                    <button wire:click="confirmDelete({{ $c->id }})" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">Supprimer</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">Aucun cours trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $cours->links() }}</div>

    <!-- Modal Ajout/Édition -->
    @if($showForm || $showEditForm)
    <div class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
        <div class="bg-white rounded p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">{{ $showEditForm ? 'Éditer le cours' : 'Ajouter un nouveau cours' }}</h2>
            <form wire:submit.prevent="saveCourse">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Titre</label>
                    <input wire:model.defer="titre" type="text" class="w-full border rounded p-2" placeholder="Ex: PHP débutant">
                    @error('titre') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea wire:model.defer="description" class="w-full border rounded p-2" placeholder="Ex: Introduction à PHP"></textarea>
                    @error('description') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="$set('showForm', false); $set('showEditForm', false)" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">{{ $showEditForm ? 'Enregistrer' : 'Ajouter' }}</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Modal Confirmation Suppression -->
    @if($confirmDeleteId)
    <div class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
        <div class="bg-white rounded p-6 w-full max-w-sm">
            <h2 class="text-lg font-bold mb-4">Confirmer la suppression</h2>
            <p class="mb-4">Voulez-vous vraiment supprimer ce cours ? Cette action est irréversible.</p>
            <div class="flex justify-end space-x-2">
                <button wire:click="$set('confirmDeleteId', null)" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                <button wire:click="deleteCourse" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Supprimer</button>
            </div>
        </div>
    </div>
    @endif
</div>
