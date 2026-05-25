<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleReportController;
use App\Http\Controllers\MechanicRequestController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Página Principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Perfil Usuario
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Búsqueda VIN
|--------------------------------------------------------------------------
*/

Route::get('/vin-search',
    [VehicleReportController::class, 'index']
)->middleware('auth')->name('vin.search');

Route::post('/vin-search',
    [VehicleReportController::class, 'store']
)->middleware('auth')->name('vin.store');

Route::get('/vin-report/{id}',
    [VehicleReportController::class, 'show']
)->middleware('auth')->name('vin.show');

/*
|--------------------------------------------------------------------------
| Premium
|--------------------------------------------------------------------------
*/

Route::get('/premium-report', function () {

    return 'Reporte Premium';

})->middleware('premium');

/*
|--------------------------------------------------------------------------
| Pagos Premium
|--------------------------------------------------------------------------
*/

Route::get('/upgrade',
    [PaymentController::class, 'premiumPage']
)->middleware('auth');

Route::post('/process-payment',
    [PaymentController::class, 'processPayment']
)->middleware('auth');

/*
|--------------------------------------------------------------------------
| Histoerial de Pagos Premium
|--------------------------------------------------------------------------
*/

Route::get('/payment-history', function () {

    $payments = auth()->user()
        ->payments()
        ->latest()
        ->get();

    return view(
        'payments.history',
        compact('payments')
    );

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Mecánicos
|--------------------------------------------------------------------------
*/

Route::get('/mechanics', function () {

    $mechanics = \App\Models\Mechanic::all();

    return view('mechanics.index', compact('mechanics'));

})->middleware('auth');

Route::get('/mechanic-request/{id}',
    [MechanicRequestController::class, 'create']
)->middleware('auth');

Route::post('/mechanic-request/store',
    [MechanicRequestController::class, 'store']
)->middleware('auth');

Route::get('/my-mechanic-requests',
    [MechanicRequestController::class, 'myRequests']
)->middleware('auth');

Route::post('/request-status/{id}/{status}',
    [MechanicRequestController::class, 'updateStatus']
)->middleware('auth');

/*
|--------------------------------------------------------------------------
| Administración
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {

    return 'Panel Administrador';

})->middleware('admin');

Route::get('/admin/dashboard', function () {

    $users = \App\Models\User::count();

    $reports = \App\Models\VehicleReport::count();

    $payments = \App\Models\Payment::count();

    $mechanics = \App\Models\Mechanic::count();

    return view('admin.dashboard', compact(
        'users',
        'reports',
        'payments',
        'mechanics'
    ));

})->middleware('admin');

Route::get('/admin/users', function () {

    $users = \App\Models\User::latest()->get();

    return view('admin.users', compact('users'));

})->middleware('admin');

Route::get('/admin/reports', function () {

    $reports = \App\Models\VehicleReport::latest()->get();

    return view('admin.reports', compact('reports'));

})->middleware('admin');

Route::get('/admin/requests',
    [MechanicRequestController::class, 'adminRequests']
)->middleware('admin');

/*
|--------------------------------------------------------------------------
| Auth Laravel
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';