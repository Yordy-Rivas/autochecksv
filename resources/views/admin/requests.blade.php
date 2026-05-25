@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-10">

    <h1 class="text-4xl font-bold mb-8">

        Solicitudes Mecánicos

    </h1>

    @foreach($requests as $request)

        <div class="bg-white shadow rounded p-6 mb-6">

            <h2 class="text-2xl font-bold">
                {{ $request->customer_name }}
            </h2>

            <p>{{ $request->vehicle }}</p>

            <p>{{ $request->problem_description }}</p>

            <p class="mb-4">

                Estado:
                {{ $request->status }}

            </p>

            <a href="/request-status/{{ $request->id }}/Aceptado"
               class="bg-green-500 text-white px-4 py-2 rounded">

               Aceptar

            </a>

            <a href="/request-status/{{ $request->id }}/Rechazado"
               class="bg-red-500 text-white px-4 py-2 rounded">

               Rechazar

            </a>

            <a href="/request-status/{{ $request->id }}/Completado"
               class="bg-blue-500 text-white px-4 py-2 rounded">

               Completar

            </a>

        </div>

    @endforeach

</div>

@endsection