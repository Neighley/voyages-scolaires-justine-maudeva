<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voyage à') }} {{ $voyage->destination }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                
                <div class="flex justify-between items-center border-b pb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Détails du voyage</h3>
                        <p class="text-gray-500 text-sm">Organisé par {{ $voyage->user->name }}</p>
                    </div>
                    <div class="flex space-x-2">
                        @can('update', $voyage)
                            <a href="{{ route('voyages.edit', $voyage) }}" class="bg-yellow-500 text-white px-4 py-2 rounded font-bold hover:bg-yellow-600 transition">Modifier</a>
                        @endcan
                        @can('delete', $voyage)
                            <form action="{{ route('voyages.destroy', $voyage) }}" method="POST" onsubmit="return confirm('Supprimer ce voyage ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded font-bold hover:bg-red-600 transition">Supprimer</button>
                            </form>
                        @endcan
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div>
                            <strong>Date de départ :</strong> {{ \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') }}
                        </div>
                        <div>
                            <strong>Date de retour :</strong> {{ \Carbon\Carbon::parse($voyage->date_retour)->format('d/m/Y') }}
                        </div>
                        <div>
                            <strong>Places disponibles :</strong> 
                            {{ $voyage->places_max - $voyage->participants->count() }} / {{ $voyage->places_max }}
                        </div>
                    </div>

                    <div class="flex items-center justify-start md:justify-end">
                        @if(Auth::user()->role === 'eleve')
                            @php
                                $isRegistered = $voyage->participants->contains('user_id', Auth::id());
                            @endphp

                            @if(!$isRegistered)
                                @if($voyage->participants->count() < $voyage->places_max)
                                    <form action="{{ route('voyages.participants.store', $voyage) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded font-bold hover:bg-blue-600 transition">
                                            S'inscrire à ce voyage
                                        </button>
                                    </form>
                                @else
                                    <div class="text-red-500 font-bold">Ce voyage est complet.</div>
                                @endif
                            @else
                                <div class="bg-blue-100 text-blue-700 px-6 py-3 rounded font-bold">
                                    Vous êtes inscrit à ce voyage.
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="pt-6 border-t">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Liste des participants</h4>
                    @if($voyage->participants->isEmpty())
                        <p class="text-gray-500">Aucun participant inscrit pour le moment.</p>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50 text-gray-700">
                                    <th class="py-3 px-4 font-semibold">Nom</th>
                                    <th class="py-3 px-4 font-semibold">Email</th>
                                    <th class="py-3 px-4 font-semibold">Autorisation Parentale</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($voyage->participants as $participant)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="py-3 px-4">{{ $participant->user->name }}</td>
                                        <td class="py-3 px-4">{{ $participant->user->email }}</td>
                                        <td class="py-3 px-4">
                                            @if($participant->autorisation_parent)
                                                <span class="text-green-600 font-bold flex items-center">
                                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Signée (Accordé)
                                                </span>
                                            @else
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-red-500 font-bold">En attente</span>
                                                    @can('update', $participant)
                                                        <form action="{{ route('participants.autoriser', $participant) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs px-2 py-1 rounded transition">
                                                                Signer
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
