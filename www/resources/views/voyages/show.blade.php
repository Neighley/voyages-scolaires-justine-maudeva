<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du voyage') }}
        </h2>
    </x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Détails du voyage : {{ $voyage->destination }}</h2>

            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700">Date de départ</h3>
                    <p class="text-gray-900 text-lg">{{ $voyage->date_depart }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700">Date de retour</h3>
                    <p class="text-gray-900 text-lg">{{ $voyage->date_retour }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700">Places maximum</h3>
                    <p class="text-gray-900 text-lg">{{ $voyage->places_max }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700">Organisateur</h3>
                    <p class="text-gray-900 text-lg">{{ $voyage->user ? $voyage->user->name : 'N/A' }}</p>
                </div>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('voyages.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Retour à la liste
                </a>
                
                @can('update', $voyage)
                    <a href="{{ route('voyages.edit', $voyage) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Éditer
                    </a>
                @endcan
                
                @can('delete', $voyage)
                    <form action="{{ route('voyages.destroy', $voyage) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce voyage ?');">
                            Supprimer
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>

</x-app-layout>
