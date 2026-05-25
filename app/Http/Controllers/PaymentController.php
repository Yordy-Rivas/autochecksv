<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function premiumPage()
    {
        return view('payments.premium');
    }

    public function processPayment(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validaciones
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'card_holder' => 'required|min:5',

            'card_number' => [
                'required',
                'regex:/^\d{16}$/'
            ],

            'expiration' => 'required',

            'cvv' => [
                'required',
                'regex:/^\d{3}$/'
            ],

            'postal_code' => 'required|min:4',

            'email' => 'required|email'

        ]);

        /*
        |--------------------------------------------------------------------------
        | Simulación bancaria
        |--------------------------------------------------------------------------
        */

        sleep(2);

        /*
        |--------------------------------------------------------------------------
        | Limpiar tarjeta
        |--------------------------------------------------------------------------
        */

        $cleanCard = preg_replace(
            '/\D/',
            '',
            $request->card_number
        );

        /*
        |--------------------------------------------------------------------------
        | Generar transacción
        |--------------------------------------------------------------------------
        */

        $transactionId = 'TXN-' . strtoupper(uniqid());

        /*
        |--------------------------------------------------------------------------
        | Guardar pago
        |--------------------------------------------------------------------------
        */

        Payment::create([

            'user_id' => auth()->id(),

            'transaction_id' => $transactionId,

            'card_holder' => $request->card_holder,

            'last_digits' => substr($cleanCard, -4),

            'email' => $request->email,

            'postal_code' => $request->postal_code,

            'amount' => 9.99,

            'status' => 'Pagado'

        ]);

        /*
        |--------------------------------------------------------------------------
        | Activar premium
        |--------------------------------------------------------------------------
        */

        auth()->user()->update([

            'is_premium' => true

        ]);

        /*
        |--------------------------------------------------------------------------
        | Generar factura PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView('invoices.invoice', [

            'user' => auth()->user(),

            'transactionId' => $transactionId

        ]);

        /*
        |--------------------------------------------------------------------------
        | Descargar factura
        |--------------------------------------------------------------------------
        */

        return $pdf->download('factura-premium.pdf');
    }
}