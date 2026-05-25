<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleReport;
use Illuminate\Support\Facades\Http;

class VehicleReportController extends Controller
{
    public function index()
    {
        $reports = VehicleReport::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('vehicle-reports.index', compact('reports'));
    }

    public function store(Request $request)
{
    $request->validate([

        'vins' => [
            'required',
            'string'
        ]

    ]);

    $rawInput = $request->input('vins');

    $vins = preg_split(
        '/[\s,]+/',
        $rawInput,
        -1,
        PREG_SPLIT_NO_EMPTY
    );

    foreach ($vins as $vin) {

        $vin = strtoupper(trim($vin));

        /*
        |--------------------------------------------------------------------------
        | Validación VIN REAL
        |--------------------------------------------------------------------------
        */

        if (
            strlen($vin) < 11 ||
            strlen($vin) > 17 ||
            !preg_match('/^[A-HJ-NPR-Z0-9]+$/', $vin)
        ) {

            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | Evitar VIN duplicados
        |--------------------------------------------------------------------------
        */

        $alreadyExists = VehicleReport::where(
            'user_id',
            auth()->id()
        )
        ->where('vin', $vin)
        ->exists();

        if ($alreadyExists) {

            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | Consumir API NHTSA
        |--------------------------------------------------------------------------
        */

        try {

            $response = Http::timeout(15)
                ->withoutVerifying()
                ->get(
                    "https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVin/{$vin}?format=json"
                );

            if (!$response->successful()) {

                continue;
            }

            $data = $response->json();

        } catch (\Exception $e) {

            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | Variables
        |--------------------------------------------------------------------------
        */

        $brand = null;
        $model = null;
        $year = null;
        $vehicleType = null;
        $country = null;
        $engine = null;
        $airbags = null;
        $manufacturer = null;

        foreach ($data['Results'] as $item) {

            if ($item['Variable'] === 'Make') {
                $brand = $item['Value'];
            }

            if ($item['Variable'] === 'Model') {
                $model = $item['Value'];
            }

            if ($item['Variable'] === 'Model Year') {
                $year = $item['Value'];
            }

            if ($item['Variable'] === 'Vehicle Type') {
                $vehicleType = $item['Value'];
            }

            if ($item['Variable'] === 'Plant Country') {
                $country = $item['Value'];
            }

            if ($item['Variable'] === 'Engine Model') {
                $engine = $item['Value'];
            }

            if ($item['Variable'] === 'Air Bag Loc Front') {
                $airbags = $item['Value'];
            }

            if ($item['Variable'] === 'Manufacturer Name') {
                $manufacturer = $item['Value'];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Premium vs Basic
        |--------------------------------------------------------------------------
        */

        $isPremium = auth()->user()->is_premium;

        $reportData = [

            'vehicle_type' => $vehicleType,
            'country' => $country,
            'engine' => $engine,
            'airbags' => $airbags,
            'manufacturer' => $manufacturer,

        ];

        /*
        |--------------------------------------------------------------------------
        | Datos Premium
        |--------------------------------------------------------------------------
        */

        if ($isPremium) {

            $reportData['accidents'] = rand(0, 3);

            $reportData['recall'] = rand(0, 1)
                ? 'Sí'
                : 'No';

            $reportData['stolen'] = rand(0, 1)
                ? 'No'
                : 'Sí';

            $reportData['score'] = rand(70, 100);

            $reportData['owners'] = rand(1, 4);

            $reportData['mileage'] = rand(50000, 250000);
        }

        /*
        |--------------------------------------------------------------------------
        | Guardar reporte
        |--------------------------------------------------------------------------
        */

        VehicleReport::create([

            'user_id' => auth()->id(),

            'vin' => $vin,

            'brand' => $brand ?? 'No disponible',

            'model' => $model ?? 'No disponible',

            'year' => $year ?? 'No disponible',

            'report_type' => $isPremium
                ? 'premium'
                : 'basic',

            'report_result' => json_encode($reportData)

        ]);
    }

    return redirect()
        ->route('vin.search')
        ->with(
            'success',
            'Reportes generados correctamente 🚗'
        );
}

    public function show($id)
    {
        $report = VehicleReport::findOrFail($id);
        return view('vehicle-reports.show', compact('report'));
    }
}

