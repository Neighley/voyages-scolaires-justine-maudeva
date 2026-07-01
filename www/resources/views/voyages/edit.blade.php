<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Éditer le voyage') }}
        </h2>
    </x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Éditer le voyage : {{ $voyage->destination }}</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('voyages.update', $voyage) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="destination" class="block text-gray-700 text-sm font-bold mb-2">Destination</label>
                    <input type="text" name="destination" id="destination" value="{{ old('destination', $voyage->destination) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="date_depart" class="block text-gray-700 text-sm font-bold mb-2">Date de départ</label>
                    <input type="date" name="date_depart" id="date_depart" value="{{ old('date_depart', $voyage->date_depart) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="date_retour" class="block text-gray-700 text-sm font-bold mb-2">Date de retour</label>
                    <input type="date" name="date_retour" id="date_retour" value="{{ old('date_retour', $voyage->date_retour) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-6">
                    <label for="places_max" class="block text-gray-700 text-sm font-bold mb-2">Nombre de places maximum</label>
                    <input type="number" name="places_max" id="places_max" value="{{ old('places_max', $voyage->places_max) }}" min="1" max="200" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Mettre à jour le voyage
                    </button>
                    <a href="{{ route('voyages.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>
