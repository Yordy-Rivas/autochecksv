@extends('layouts.app')

@section('content')

@php

    $details = json_decode($report->report_result, true);

    $score = $details['score'] ?? 80;

@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Información principal -->

    <div class="md:col-span-2 bg-white p-8 rounded-2xl shadow">

        <div class="flex justify-between items-center mb-8">

            <h1 class="text-4xl font-bold">

                Reporte Vehicular 🚗

            </h1>

            @if($report->report_type === 'premium')

                <span class="bg-yellow-500 text-white px-4 py-2 rounded-full">

                    PREMIUM

                </span>

            @else

                <span class="bg-gray-500 text-white px-4 py-2 rounded-full">

                    BASIC

                </span>

            @endif

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <strong>VIN:</strong>
                <br>
                {{ $report->vin }}
            </div>

            <div>
                <strong>Marca:</strong>
                <br>
                {{ $report->brand }}
            </div>

            <div>
                <strong>Modelo:</strong>
                <br>
                {{ $report->model }}
            </div>

            <div>
                <strong>Año:</strong>
                <br>
                {{ $report->year }}
            </div>

            <div>
                <strong>Tipo Vehículo:</strong>
                <br>
                {{ $details['vehicle_type'] ?? 'N/A' }}
            </div>

            <div>
                <strong>País Fabricación:</strong>
                <br>
                {{ $details['country'] ?? 'N/A' }}
            </div>

            <div>
                <strong>Motor:</strong>
                <br>
                {{ $details['engine'] ?? 'N/A' }}
            </div>

            <div>
                <strong>Airbags:</strong>
                <br>
                {{ $details['airbags'] ?? 'N/A' }}
            </div>

            <div>
                <strong>Fabricante:</strong>
                <br>
                {{ $details['manufacturer'] ?? 'N/A' }}
            </div>

        </div>

    </div>

    <!-- Score -->

    <div class="bg-white p-8 rounded-2xl shadow flex flex-col justify-center">

        <h2 class="text-3xl font-bold mb-6">

            Score Vehicular

        </h2>

        <div class="text-7xl font-bold text-green-600">

            {{ $score }}

        </div>

        <p class="mt-4 text-gray-600">

            Estado General Vehicular

        </p>

    </div>

</div>

<!-- Indicadores Premium -->

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-10">

    <div class="bg-red-100 p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-bold">

            Accidentes

        </h2>

        <p class="text-5xl mt-4">

            {{ $details['accidents'] ?? 'N/A' }}

        </p>

    </div>

    <div class="bg-yellow-100 p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-bold">

            Recall

        </h2>

        <p class="text-3xl mt-4">

            {{ $details['recall'] ?? 'N/A' }}

        </p>

    </div>

    <div class="bg-green-100 p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-bold">

            Reporte Robo

        </h2>

        <p class="text-3xl mt-4">

            {{ $details['stolen'] ?? 'N/A' }}

        </p>

    </div>

    <div class="bg-blue-100 p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-bold">

            Dueños

        </h2>

        <p class="text-5xl mt-4">

            {{ $details['owners'] ?? 'N/A' }}

        </p>

    </div>

</div>

<!-- Más detalles -->

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

    <div class="bg-purple-100 p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-bold mb-4">

            Kilometraje

        </h2>

        <p class="text-4xl">

            {{ number_format($details['mileage'] ?? 0) }} km

        </p>

    </div>

    <div class="bg-indigo-100 p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-bold mb-4">

            Tipo Reporte

        </h2>

        <p class="text-4xl uppercase">

            {{ $report->report_type }}

        </p>

    </div>

</div>

<!-- API Response -->

<div class="bg-gray-50 p-6 rounded-2xl shadow mt-10">

    <h2 class="text-2xl font-bold mb-6">

        Datos completos API NHTSA

    </h2>

    <pre class="bg-white p-4 rounded-xl shadow overflow-x-auto text-sm">
{{ json_encode($details, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
    </pre>

</div>

@endsection
