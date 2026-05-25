@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-5xl font-bold mb-10">

        Admin Dashboard 🚀

    </h1>

    <!-- CARDS -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-blue-600 text-white p-6 rounded-2xl shadow">

            <h2 class="text-4xl font-bold">

                {{ $users }}

            </h2>

            <p class="mt-2">
                Usuarios
            </p>

        </div>

        <div class="bg-green-600 text-white p-6 rounded-2xl shadow">

            <h2 class="text-4xl font-bold">

                {{ $reports }}

            </h2>

            <p class="mt-2">
                Reportes VIN
            </p>

        </div>

        <div class="bg-yellow-500 text-white p-6 rounded-2xl shadow">

            <h2 class="text-4xl font-bold">

                {{ $payments }}

            </h2>

            <p class="mt-2">
                Pagos Premium
            </p>

        </div>

        <div class="bg-red-500 text-white p-6 rounded-2xl shadow">

            <h2 class="text-4xl font-bold">

                {{ $mechanics }}

            </h2>

            <p class="mt-2">
                Mecánicos
            </p>

        </div>

    </div>

    <!-- GRAFICA -->

    <div class="bg-white p-8 rounded-2xl shadow">

        <h2 class="text-3xl font-bold mb-6">

            Estadísticas Plataforma 📊

        </h2>

        <canvas id="statsChart"></canvas>

    </div>

</div>

<!-- CHART JS -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('statsChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Usuarios',

            'Reportes',

            'Pagos',

            'Mecánicos'

        ],

        datasets: [{

            label: 'Sistema AutoCheckSV',

            data: [

                {{ $users }},

                {{ $reports }},

                {{ $payments }},

                {{ $mechanics }}

            ],

            borderWidth: 1

        }]
    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>

@endsection