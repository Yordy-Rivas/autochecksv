<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mechanic;
use App\Models\MechanicRequest;

class MechanicRequestController extends Controller
{
    public function create($id)
    {
        $mechanic = Mechanic::findOrFail($id);

        return view('mechanics.request', compact('mechanic'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'customer_name' => 'required|min:3',

            'phone' => [
                'required',
                'regex:/^[267]\d{3}-\d{4}$/'
            ],

            'vehicle' => 'required',

            'vin' => [
                'required',
                'min:11',
                'max:17',
                'regex:/^[A-HJ-NPR-Z0-9]+$/'
            ],

            'problem_description' => 'required|min:10',

            'appointment_date' => 'required|date',

            'appointment_time' => 'required',

            'address' => 'required|min:10',

            'service_type' => 'required',

        ]);

        MechanicRequest::create([

            'user_id' => auth()->id(),

            'mechanic_id' => $request->mechanic_id,

            'customer_name' => $request->customer_name,

            'phone' => $request->phone,

            'vehicle' => $request->vehicle,

            'vin' => $request->vin,

            'problem_description' => $request->problem_description,

            'appointment_date' => $request->appointment_date,

            'appointment_time' => $request->appointment_time,

            'address' => $request->address,

            'service_type' => $request->service_type,

            'status' => 'Pendiente'

        ]);

        return redirect('/mechanics')
            ->with('success', 'Solicitud enviada correctamente.');
    }

    public function myRequests()
    {
        $requests = MechanicRequest::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view(
            'mechanics.my-requests',
            compact('requests')
        );
    }

    public function updateStatus($id, $status)
    {
        $request = MechanicRequest::findOrFail($id);

        $request->update([
            'status' => $status
        ]);

        return back()
            ->with('success', 'Estado actualizado.');
    }

    public function adminRequests()
    {
        $requests = MechanicRequest::latest()->get();

        return view(
            'admin.requests',
            compact('requests')
        );
    }
}
