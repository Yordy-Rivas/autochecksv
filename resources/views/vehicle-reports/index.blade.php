@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white p-8 rounded shadow-md">
    <h1 class="text-3xl font-bold mb-6">
        Buscar Vehículos por VIN
    </h1>

    <form action="{{ route('vin.store') }}" method="POST">
        @csrf
        <textarea
            name="vins"
            placeholder="Ingrese uno o más VINs (separados por coma o salto de línea)"
            class="w-full border rounded px-4 py-2 mb-4"
            rows="5"
        ></textarea>

        <button
            type="submit"
            onclick="this.innerHTML='Buscando...';"
            class="bg-blue-600 text-white px-6 py-2 rounded">
            Buscar
        </button>
    </form>
</div>

<div class="mt-10">
    <h2 class="text-2xl font-bold mb-4">
        Historial de Reportes
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($reports as $report)
            @php
                $details = json_decode($report->report_result, true);
                $score = $details['score'] ?? 'N/A';

                // Colores dinámicos según el score
                $scoreColor = 'text-gray-600';
                if (is_numeric($score)) {
                    if ($score >= 85) $scoreColor = 'text-green-600';
                    elseif ($score >= 70) $scoreColor = 'text-yellow-600';
                    else $scoreColor = 'text-red-600';
                }
            @endphp

            <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold mb-2">{{ $report->brand }} {{ $report->model }}</h3>
                <p class="text-gray-600 mb-2"><strong>VIN:</strong> {{ $report->vin }}</p>
                <p class="text-gray-600 mb-2"><strong>Año:</strong> {{ $report->year }}</p>
                <p class="text-gray-600 mb-2"><strong>Score:</strong> 
                    <span class="font-bold {{ $scoreColor }}">{{ $score }}</span>
                </p>
                <p class="text-gray-500 text-sm mb-4">
                    Generado el {{ $report->created_at->format('d/m/Y') }}
                </p>
                <a href="{{ route('vin.show', $report->id) }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Ver Detalle
                </a>
            </div>
        @empty
            <div class="col-span-3 text-center py-10">
                <div class="text-6xl mb-4">🚗</div>
                <p class="text-gray-500 text-xl">Aún no tienes reportes generados</p>
            </div>
        @endforelse
    </div>
</div>

@endsection

