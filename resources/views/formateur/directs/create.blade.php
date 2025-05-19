@extends('layouts.app')
@section('title', 'Créer un direct')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Créer un direct</h1>
    <form method="POST" action="{{ route('formateur.direct.store') }}" class="bg-white rounded shadow p-6 max-w-lg mx-auto">
        @csrf
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-2">Titre du direct</label>
            <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-2">Description</label>
            <textarea id="description" name="description" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
        </div>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded font-bold">Lancer le direct</button>
    </form>
</div>
@endsection
