@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-10">

    <h1 class="text-4xl font-bold mb-8">

        Mis Solicitudes 🔧

    </h1>

    @foreach($requests as $request)

        <div class="bg-white shadow rounded p-6 mb-6">

            <h2 class="text-2xl font-bold mb-2">
                {{ $request->vehicle }}
            </h2>

            <p>
                <strong>VIN:</strong>
                {{ $request->vin }}
            </p>

            <p>
                <strong>Problema:</strong>
                {{ $request->problem_description }}
            </p>

            <p>
                <strong>Fecha:</strong>
                {{ $request->appointment_date }}
            </p>

            <p>
                <strong>Estado:</strong>

                <span class="bg-yellow-200 px-3 py-1 rounded">

                    {{ $request->status }}

                </span>

            </p>

        </div>

    @endforeach

</div>

@endsection