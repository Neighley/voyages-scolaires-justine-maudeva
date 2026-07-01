@extends('layouts.app')
@section('content')

<h1>Liste des voyages</h1>

@can('create', App\Models\Voyage::class)
    <a href="{{ route('voyages.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600 inline-block mb-4">+ Nouveau voyage</a>
@endcan

@foreach ($voyages as $voyage)
    <div>
        <strong>{{ $voyage->destination }}</strong>
        {{ $voyage->date_depart }} -> {{ $voyage->date_retour }}
        <a href="{{ route('voyages.show', $voyage) }}">Détail</a>
    </div>
@endforeach

@endsection