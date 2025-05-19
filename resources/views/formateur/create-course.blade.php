@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Créer un nouveau cours</h1>
    <form method="POST" action="{{ route('formateur.courses.store') }}">
        @csrf
        <div class="mb-4">
            <label for="title" class="block font-semibold">Titre du cours</label>
            <input type="text" name="title" id="title" class="border rounded w-full p-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" class="border rounded w-full p-2"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Créer</button>
    </form>
</div>
@endsection


