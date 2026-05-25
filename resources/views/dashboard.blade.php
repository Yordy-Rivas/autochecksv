@extends('layouts.app')

@php

$reportsCount = auth()->user()->vehicleReports()->count();

@endphp

@section('content')

<div class="min-h-screen bg-gray-100">

    <div class="flex">

        <!-- SIDEBAR -->

        <div class="w-72 bg-slate-900 min-h-screen text-white p-6">

            <h1 class="text-3xl font-bold mb-10">
                🚗 AutoCheck SV
            </h1>

            <!-- USER MENU -->

            <p class="text-gray-400 uppercase text-sm mb-4">
                Usuario
            </p>

            <div class="space-y-3">

                <a href="/dashboard"
                   class="block bg-slate-800 hover:bg-slate-700 px-5 py-4 rounded-xl transition">

                    🏠 Dashboard

                </a>

                <a href="/vin-search"
                   class="block bg-indigo-600 hover:bg-indigo-700 px-5 py-4 rounded-xl transition">

                    🔎 Buscar VIN

                </a>

                <a href="/mechanics"
                   class="block bg-green-600 hover:bg-green-700 px-5 py-4 rounded-xl transition">

                    🔧 Mecánicos

                </a>

                <a href="/my-mechanic-requests"
                   class="block bg-gray-700 hover:bg-gray-600 px-5 py-4 rounded-xl transition">

                    📋 Mis Solicitudes

                </a>

                <a href="/payment-history"
                   class="block bg-blue-600 hover:bg-blue-700 px-5 py-4 rounded-xl transition">

                    💳 Historial Pagos

                </a>

                <a href="/upgrade"
                   class="block bg-yellow-500 hover:bg-yellow-600 px-5 py-4 rounded-xl transition">

                    👑 Premium

                </a>

            </div>

            <!-- ADMIN -->

            @if(auth()->user()->is_admin)

            <div class="mt-12">

                <p class="text-red-400 uppercase text-sm mb-4">
                    Administración
                </p>

                <div class="space-y-3">

                    <a href="/admin/dashboard"
                       class="block bg-red-600 hover:bg-red-700 px-5 py-4 rounded-xl transition">

                        ⚙️ Dashboard Admin

                    </a>

                    <a href="/admin/users"
                       class="block bg-blue-600 hover:bg-blue-700 px-5 py-4 rounded-xl transition">

                        👥 Usuarios

                    </a>

                    <a href="/admin/reports"
                       class="block bg-green-600 hover:bg-green-700 px-5 py-4 rounded-xl transition">

                        📄 Reportes

                    </a>

                    <a href="/admin/requests"
                       class="block bg-yellow-500 hover:bg-yellow-600 px-5 py-4 rounded-xl transition">

                        🛠 Solicitudes

                    </a>

                </div>

            </div>

            @endif

        </div>

        <!-- CONTENT -->

        <div class="flex-1 p-10">

            <!-- TOP -->

            <div class="bg-white rounded-3xl shadow p-10 mb-10">

                <div class="flex items-center justify-between">

                    <div>

                        <h1 class="text-5xl font-bold mb-4">
                            Bienvenido 👋
                        </h1>

                        <p class="text-gray-600 text-lg">
                            Sistema inteligente de verificación vehicular.
                        </p>

                    </div>

                    <div>

                        @if(auth()->user()->is_premium)

                            <span class="bg-yellow-400 text-black px-6 py-3 rounded-full font-bold">

                                PREMIUM 👑

                            </span>

                        @else

                            <span class="bg-gray-200 px-6 py-3 rounded-full font-bold">

                                FREE

                            </span>

                        @endif

                    </div>

                </div>

            </div>

            <!-- STATS -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

                <!-- REPORTES -->

                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-8 rounded-3xl shadow-lg">

                    <div class="text-5xl mb-4">
                        📄
                    </div>

                    <h2 class="text-5xl font-bold">

                        {{ $reportsCount }}

                    </h2>

                    <p class="mt-4 text-lg">
                        Reportes Generados
                    </p>

                </div>

                <!-- PREMIUM -->

                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white p-8 rounded-3xl shadow-lg">

                    <div class="text-5xl mb-4">
                        👑
                    </div>

                    <h2 class="text-4xl font-bold">

                        @if(auth()->user()->is_premium)

                            PREMIUM

                        @else

                            FREE

                        @endif

                    </h2>

                    <p class="mt-4 text-lg">
                        Tipo de Cuenta
                    </p>

                </div>

                <!-- STATUS -->

                <div class="bg-gradient-to-r from-green-500 to-green-700 text-white p-8 rounded-3xl shadow-lg">

                    <div class="text-5xl mb-4">
                        🟢
                    </div>

                    <h2 class="text-4xl font-bold">

                        Activa

                    </h2>

                    <p class="mt-4 text-lg">
                        Estado Plataforma
                    </p>

                </div>

            </div>

            <!-- QUICK ACTIONS -->

            <div class="bg-white rounded-3xl shadow p-10">

                <h2 class="text-3xl font-bold mb-8">
                    Acciones Rápidas 🚀
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                    <!-- VIN -->

                    <a href="/vin-search"
                       class="bg-indigo-100 hover:bg-indigo-200 p-8 rounded-3xl transition shadow">

                        <div class="text-5xl mb-4">
                            🔎
                        </div>

                        <h3 class="text-2xl font-bold mb-2">
                            Buscar VIN
                        </h3>

                        <p class="text-gray-600">
                            Consulta información completa del vehículo.
                        </p>

                    </a>

                    <!-- PREMIUM -->

                    <a href="/upgrade"
                       class="bg-yellow-100 hover:bg-yellow-200 p-8 rounded-3xl transition shadow">

                        <div class="text-5xl mb-4">
                            👑
                        </div>

                        <h3 class="text-2xl font-bold mb-2">
                            Obtener Premium
                        </h3>

                        <p class="text-gray-600">
                            Desbloquea reportes avanzados y funciones exclusivas.
                        </p>

                    </a>

                    <!-- MECANICOS -->

                    <a href="/mechanics"
                       class="bg-green-100 hover:bg-green-200 p-8 rounded-3xl transition shadow">

                        <div class="text-5xl mb-4">
                            🔧
                        </div>

                        <h3 class="text-2xl font-bold mb-2">
                            Mecánicos
                        </h3>

                        <p class="text-gray-600">
                            Agenda revisiones con expertos certificados.
                        </p>

                    </a>

                    <!-- SOLICITUDES -->

                    <a href="/my-mechanic-requests"
                       class="bg-gray-100 hover:bg-gray-200 p-8 rounded-3xl transition shadow">

                        <div class="text-5xl mb-4">
                            📋
                        </div>

                        <h3 class="text-2xl font-bold mb-2">
                            Mis Solicitudes
                        </h3>

                        <p class="text-gray-600">
                            Consulta el estado de tus solicitudes mecánicas.
                        </p>

                    </a>

                    <!-- PAGOS -->

                    <a href="/payment-history"
                       class="bg-blue-100 hover:bg-blue-200 p-8 rounded-3xl transition shadow">

                        <div class="text-5xl mb-4">
                            💳
                        </div>

                        <h3 class="text-2xl font-bold mb-2">
                            Historial Pagos
                        </h3>

                        <p class="text-gray-600">
                            Revisa todas tus transacciones y facturas.
                        </p>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
