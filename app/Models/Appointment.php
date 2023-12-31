<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'user_id',
        'date', // Match with the column name 'date'
        'time', // Match with the column name 'time'
        'type',
        'reason',
        'status',
        'counselor_id',
        'recording',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function acceptedAppointment()
{
    return $this->hasOne(AcceptedAppointment::class, 'appointment_id');
}

public function deleteWithAcceptedAppointments()
    {
        // Check if there's an associated accepted appointment
        if ($this->acceptedAppointment) {
            $this->acceptedAppointment->delete();
        }

        // Finally, delete the appointment itself
        $this->delete();
    }

    public function counselor()
{
    return $this->belongsTo(User::class, 'counselor_id');
}
    
}

