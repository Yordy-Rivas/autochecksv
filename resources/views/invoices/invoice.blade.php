<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Factura Premium</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }

        .title {
            font-size: 30px;
            font-weight: bold;
        }

        .success {
            color: green;
            font-size: 22px;
        }

        .mt {
            margin-top: 20px;
        }

    </style>

</head>

<body>

    <div class="header">

        <div class="title">

            AutoCheck SV 🚗

        </div>

        <p>
            Factura Premium
        </p>

    </div>

    <div class="box">

        <h2 class="success">

            Pago Procesado Correctamente

        </h2>

        <div class="mt">

            <strong>Usuario:</strong>

            {{ $user->name }}

        </div>

        <div class="mt">

            <strong>Correo:</strong>

            {{ $user->email }}

        </div>

        <div class="mt">

            <strong>Fecha:</strong>

            {{ now()->format('d/m/Y H:i') }}

        </div>

        <div class="mt">

            <strong>ID Transacción:</strong>

            {{ $transactionId }}

        </div>

        <div class="mt">

            <strong>Plan:</strong>

            Premium

        </div>

        <div class="mt">

            <strong>Monto:</strong>

            $9.99 USD

        </div>

    </div>

</body>

</html>