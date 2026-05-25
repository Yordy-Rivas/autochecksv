@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-10 rounded-2xl shadow">

    <h1 class="text-4xl font-bold mb-8">

        Upgrade Premium 💳

    </h1>

    <div class="bg-yellow-100 p-6 rounded mb-8">

        <h2 class="text-2xl font-bold mb-2">
            Premium Plan
        </h2>

        <p>
            Reportes completos, historial,
            análisis avanzado y soporte prioritario.
        </p>

        <p class="text-3xl font-bold mt-4">
            $9.99
        </p>

    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-400
                    text-red-700 px-4 py-3 rounded mb-6">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form method="POST" action="/process-payment">

        @csrf

        <div class="mb-4">

            <label>Nombre Titular</label>

            <input type="text"
                   name="card_holder"

                   class="w-full border border-gray-300
                          rounded-xl p-3">

        </div>

        <div class="mb-4">

            <label>Número Tarjeta</label>

            <input type="text"
                   name="card_number"

                   placeholder="1234 5678 9012"

                   class="w-full border border-gray-300
                          rounded-xl p-3">

        </div>

        <div class="grid grid-cols-2 gap-4">

            <div class="mb-4">

                <label>Expiración</label>

                <input type="text"
                       name="expiration"

                       placeholder="MM/YY"

                       class="w-full border border-gray-300
                              rounded-xl p-3">

            </div>

            <div class="mb-4">

                <label>CVV</label>

                <input type="text"
                       name="cvv"

                       placeholder="123"

                       class="w-full border border-gray-300
                              rounded-xl p-3">

            </div>

        </div>

        <div class="mb-4">

            <label>Email Facturación</label>

            <input type="email"
                   name="email"

                   class="w-full border border-gray-300
                          rounded-xl p-3">

        </div>

        <div class="mb-6">

            <label>Código Postal</label>

            <input type="text"
                   name="postal_code"

                   class="w-full border border-gray-300
                          rounded-xl p-3">

        </div>

        <button id="payBtn"

            class="bg-green-600 text-white
                   px-6 py-3 rounded-xl w-full">

            Pagar $9.99

        </button>

    </form>

</div>

<script>

document.querySelector('form')
.addEventListener('submit', function(){

    const btn =
    document.getElementById('payBtn');

    btn.innerHTML =
    'Procesando Pago... ⏳';

    btn.disabled = true;

});

</script>

@endsection