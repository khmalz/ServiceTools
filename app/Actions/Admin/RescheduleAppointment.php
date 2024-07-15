<?php

namespace App\Actions\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Notifications\RescheduleNotification;

class RescheduleAppointment
{
    /**
     * Create a new class instance.
     */
    public function handle(Appointment $appointment, Request $request)
    {
        $appointment->update([
            'propose_reschedule' => now()
        ]);

        $request->user()->notify(new RescheduleNotification('client', $appointment->id, $appointment->user->id));
    }
}
