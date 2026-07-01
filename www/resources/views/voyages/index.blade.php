@extends('layouts.app')
@section('content')

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Liste des voyages</h1>
        
        @can('create', App\Models\Voyage::class)
            <a href="{{ route('voyages.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Nouveau voyage
            </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            @if($voyages->isEmpty())
                <p class="text-gray-500">Aucun voyage n'a été créé pour le moment.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($voyages as $voyage)
                        <li class="py-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $voyage->destination }}</h3>
                                <p class="text-sm text-gray-500">Du {{ $voyage->date_depart }} au {{ $voyage->date_retour }} ({{ $voyage->places_max }} places max)</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('voyages.show', $voyage) }}" class="text-blue-600 hover:underline">Détails</a>
                                @can('update', $voyage)
                                    <a href="{{ route('voyages.edit', $voyage) }}" class="text-yellow-600 hover:underline">Éditer</a>
                                @endcan
                                @can('delete', $voyage)
                                    <form action="{{ route('voyages.destroy', $voyage) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce voyage ?');">Supprimer</button>
                                    </form>
                                @endcan
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@endsection