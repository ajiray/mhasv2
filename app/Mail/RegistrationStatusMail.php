<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\PendingUser;

class RegistrationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param string $status
     */
    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = ($this->status === 'approved') ? 'Registration Approved' : 'Registration Declined';

        return $this->subject($subject)
            ->view('emails.registration_status')
            ->with([
                'userName' => $this->user->name,
                'status' => $this->status,
            ]);
    }
}
