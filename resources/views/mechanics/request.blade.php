@extends('layouts.app')

@section('content')

<div class="bg-white p-10 rounded shadow max-w-3xl mx-auto">

    <h1 class="text-4xl font-bold mb-8">
        Solicitar Revisión 🔧
    </h1>

    <form method="POST" action="/mechanic-request/store">

        @csrf

        <input type="hidden"
               name="mechanic_id"
               value="{{ $mechanic->id }}">

        <div class="mb-4">

            <label>Nombre Completo</label>

            <input type="text"
                   name="customer_name"
                   class="w-full border rounded p-3">
        </div>

        <div class="mb-4">

            <label>Teléfono</label>

            <input type="text"
                   name="phone"
                   class="w-full border rounded p-3">
        </div>

        <div class="mb-4">

            <label>Vehículo</label>

            <input type="text"
                   name="vehicle"
                   class="w-full border rounded p-3">
        </div>

        <div class="mb-4">

            <label>VIN</label>

            <input type="text"
                   name="vin"
                   class="w-full border rounded p-3">
        </div>

        <div class="mb-4">

            <label>Problema</label>

            <textarea name="problem_description"
                      class="w-full border rounded p-3"></textarea>

        </div>

        <div class="mb-4">

            <label>Fecha</label>

            <input type="date"
                   name="appointment_date"
                   class="w-full border rounded p-3">
        </div>

        <div class="mb-4">

            <label>Hora</label>

            <input type="time"
                   name="appointment_time"
                   class="w-full border rounded p-3">
        </div>

        <div class="mb-4">

            <label>Dirección</label>

            <input type="text"
                   name="address"
                   class="w-full border rounded p-3">
        </div>

        <div class="mb-4">

            <label>Tipo Servicio</label>

            <select name="service_type"
                    class="w-full border rounded p-3">

                <option>Diagnóstico</option>

                <option>Motor</option>

                <option>Frenos</option>

                <option>Electricidad</option>

            </select>

        </div>

        <button
            class="bg-blue-600 text-white px-6 py-3 rounded">

            Enviar Solicitud

        </button>

    </form>

</div>

@endsection