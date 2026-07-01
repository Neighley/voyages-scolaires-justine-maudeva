@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Créer un nouveau voyage</h1>

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
            <label class="block font-bold">Destination</label>
            <input type="text" name="destination" class="border p-2 w-full rounded" value="{{ old('destination') }}" required>
        </div>
        <div>
            <label class="block font-bold">Date de départ</label>
            <input type="date" name="date_depart" class="border p-2 w-full rounded" value="{{ old('date_depart') }}" required>
        </div>
        <div>
            <label class="block font-bold">Date de retour</label>
            <input type="date" name="date_retour" class="border p-2 w-full rounded" value="{{ old('date_retour') }}" required>
        </div>
        <div>
            <label class="block font-bold">Places maximum</label>
            <input type="number" name="places_max" class="border p-2 w-full rounded" value="{{ old('places_max', 30) }}" min="1" max="200" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-600">Créer le voyage</button>
    </form>
</div>
@endsection
