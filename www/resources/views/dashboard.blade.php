<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-semibold text-lg">
                    Bonjour, {{ Auth::user()->name }} ! (Rôle : <span class="capitalize text-blue-600">{{ Auth::user()->role }}</span>)
                </div>
            </div>

            @if(Auth::user()->role === 'eleve')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Mes inscriptions aux voyages</h3>
                    @if($inscriptions->isEmpty())
                        <p class="text-gray-500">Vous n'êtes inscrit à aucun voyage pour le moment.</p>
                        <div class="mt-4">
                            <a href="{{ route('voyages.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600 transition">Voir les voyages disponibles</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($inscriptions as $voyage)
                                <div class="border p-4 rounded shadow-sm hover:shadow-md transition">
                                    <h4 class="font-bold text-lg text-blue-600">{{ $voyage->destination }}</h4>
                                    <p class="text-gray-600 text-sm">Départ : {{ \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') }}</p>
                                    <p class="text-gray-600 text-sm">Retour : {{ \Carbon\Carbon::parse($voyage->date_retour)->format('d/m/Y') }}</p>
                                    <div class="mt-4">
                                        <a href="{{ route('voyages.show', $voyage) }}" class="text-blue-500 hover:underline">Voir les détails du voyage</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['enseignant', 'admin']))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Mes voyages organisés</h3>
                    @if($mesVoyages->isEmpty())
                        <p class="text-gray-500">Vous n'avez créé aucun voyage pour le moment.</p>
                        <div class="mt-4">
                            <a href="{{ route('voyages.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600 transition">+ Créer un voyage</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($mesVoyages as $voyage)
                                <div class="border p-4 rounded shadow-sm hover:shadow-md transition">
                                    <h4 class="font-bold text-lg text-blue-600">{{ $voyage->destination }}</h4>
                                    <p class="text-gray-600 text-sm">Participants inscrits : {{ $voyage->participants->count() }} / {{ $voyage->places_max }}</p>
                                    <div class="mt-4">
                                        <a href="{{ route('voyages.show', $voyage) }}" class="text-blue-500 hover:underline">Gérer les inscriptions</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
