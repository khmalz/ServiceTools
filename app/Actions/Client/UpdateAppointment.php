<?php

namespace App\Actions\Client;

use App\Models\Appointment;

class UpdateAppointment
{
    public function handle(Appointment $appointment, array $data)
    {
        $appointment->update([
            'schedule' => $data['schedule']
        ]);
    }
}
