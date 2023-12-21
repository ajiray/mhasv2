<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedAppointment extends Model
{
    use HasFactory;
    
    public function appointment()
{
    return $this->belongsTo(Appointment::class, 'appointment_id');
}

public function counselor()
{
    return $this->belongsTo(User::class, 'counselor_id');
}

}
