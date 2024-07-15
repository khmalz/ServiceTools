<?php

namespace App\Actions\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;

class UpdateAppointment
{
    public function handle(Appointment $appointment, Request $request)
    {
        $appointment->update([
            'status' => $request->status
        ]);

        activity()
            ->performedOn($appointment)
            ->causedBy($request->user())
            ->withProperties([
                'status' => $request->status,
                'order_id' => $appointment->service->order_id
            ])
            ->log('Update Status Appointment Order');
    }
}
