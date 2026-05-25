@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    Mecánicos Disponibles 🔧
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    @foreach($mechanics as $mechanic)

        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-2xl font-bold">
                {{ $mechanic->name }}
            </h2>

            <p class="mt-2 text-gray-600">
                {{ $mechanic->specialty }}
            </p>

            <p class="mt-4">
                {{ $mechanic->description }}
            </p>

            <div class="mt-4">

                <a href="/mechanic-request/{{ $mechanic->id }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    Solicitar Revisión
                </a>

                <a href="https://wa.me/50377777777"
                    target="_blank"
                    class="bg-green-500 text-white px-4 py-2 rounded ml-2">

                    WhatsApp
                </a>

            </div>

        </div>

    @endforeach

</div>

@endsection