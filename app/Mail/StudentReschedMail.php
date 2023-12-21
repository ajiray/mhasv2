<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentReschedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $counselorName; // Add counselorName property
    public $studentFullName; // Add studentFullName property
    public $studentId; // Add studentId property
    public $appointment;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function __construct($counselorName, $studentFullName, $studentId, $appointment)
    {
        $this->counselorName = $counselorName;
        $this->studentFullName = $studentFullName;
        $this->studentId = $studentId;
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Appointment Rescheduled')->view('emails.emailStudent');
    }
}
