<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    public function requests()
{
    return $this->hasMany(MechanicRequest::class);
}

}
