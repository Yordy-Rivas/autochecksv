@extends('layouts.app')

@section('content')

<div class="bg-white p-10 rounded-2xl shadow">

    <h1 class="text-4xl font-bold mb-8">

        Historial de Pagos 💳

    </h1>

    <table class="w-full">

        <thead>

            <tr class="border-b">

                <th class="text-left p-4">
                    Transacción
                </th>

                <th class="text-left p-4">
                    Tarjeta
                </th>

                <th class="text-left p-4">
                    Monto
                </th>

                <th class="text-left p-4">
                    Estado
                </th>

                <th class="text-left p-4">
                    Fecha
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($payments as $payment)

            <tr class="border-b">

                <td class="p-4">

                    {{ $payment->transaction_id }}

                </td>

                <td class="p-4">

                    **** {{ $payment->last_digits }}

                </td>

                <td class="p-4">

                    ${{ $payment->amount }}

                </td>

                <td class="p-4 text-green-600">

                    {{ $payment->status }}

                </td>

                <td class="p-4">

                    {{ $payment->created_at }}

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection