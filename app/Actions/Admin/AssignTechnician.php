<?php

namespace App\Actions\Admin;

use App\Models\Technician;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InboxTechnicianNotification;

class AssignTechnician
{
    public function handle(Appointment $appointment, Request $request)
    {
        $appointment->technicians()->sync($request->technicians);

        activity()
            ->performedOn($appointment)
            ->causedBy($request->user())
            ->withProperties([
                'status' => "assign",
                'order_id' => $appointment->service->order_id
            ])
            ->log('Assign Appointment Task for Technician');

        $users = Technician::whereIn('id', $request->technicians)
            ->with('user')
            ->get()
            ->pluck('user');

        Notification::send($users, new InboxTechnicianNotification('admin', $appointment->service->id, $appointment->schedule, $appointment->status));
    }
}
