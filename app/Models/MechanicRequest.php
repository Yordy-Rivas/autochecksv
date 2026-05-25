<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MechanicRequest extends Model
{
    protected $fillable = [

        'user_id',
        'mechanic_id',
        'customer_name',
        'phone',
        'vehicle',
        'vin',
        'problem_description',
        'appointment_date',
        'appointment_time',
        'address',
        'service_type',
        'status'

    ];

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
