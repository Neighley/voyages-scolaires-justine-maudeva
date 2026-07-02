<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un nouveau voyage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-xl mx-auto">
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('voyages.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-bold text-gray-700">Destination</label>
                        <input type="text" name="destination" class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:border-blue-300" value="{{ old('destination') }}" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Date de départ</label>
                        <input type="date" name="date_depart" class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:border-blue-300" value="{{ old('date_depart') }}" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Date de retour</label>
                        <input type="date" name="date_retour" class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:border-blue-300" value="{{ old('date_retour') }}" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Places maximum</label>
                        <input type="number" name="places_max" class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:border-blue-300" value="{{ old('places_max', 30) }}" min="1" max="200" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600 transition">Créer le voyage</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
