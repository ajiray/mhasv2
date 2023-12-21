<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;

class CheckAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentTime = now();

    // Query appointments that need to be automatically declined
    $appointments = Appointment::where('status', 'waiting for approval')
        ->where('date', '<', $currentTime)
        ->get();

    foreach ($appointments as $appointment) {
        // Update the appointment status to 'declined'
        $appointment->update(['status' => 'declined']);
    }

    $this->info('Appointments checked and updated.');
    }
}
