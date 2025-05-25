@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des rôles</h1>
    <ul>
        @foreach($roles as $slug => $name)
            <li>
                <a href="{{ route('roles.show', $slug) }}">{{ $name }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
