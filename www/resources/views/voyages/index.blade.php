<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des voyages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @can('create', App\Models\Voyage::class)
                    <a href="{{ route('voyages.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600 inline-block mb-4">+ Nouveau voyage</a>
                @endcan

                <div class="space-y-4">
                    @foreach ($voyages as $voyage)
                        <div class="border-b pb-4 flex justify-between items-center">
                            <div>
                                <strong class="text-lg">{{ $voyage->destination }}</strong>
                                <span class="text-gray-500 text-sm ml-4">
                                    {{ \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') }} -> {{ \Carbon\Carbon::parse($voyage->date_retour)->format('d/m/Y') }}
                                </span>
                            </div>
                            <a href="{{ route('voyages.show', $voyage) }}" class="text-blue-500 hover:underline">Détail</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>