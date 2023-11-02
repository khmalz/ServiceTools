<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentShowController extends Controller
{
    /**
     * Show details of a appointment
     */
    public function __invoke(Request $request, Appointment $appointment)
    {
        $appointment->load('service.user.client', 'service.images', 'technicians.user');

        abort_if($request->user()->hasRole('client') && $appointment->service->user_id != $request->user()->id, 403);

        /**
         * Pengajuan reschedule null, boleh
         * Pengajuan reschedule lebih dari 24 jam, boleh
         * Pengajuan reschedule kurang dari 24 jam, tidak boleh
         */
        $isReschedulePassed = is_null($appointment->propose_reschedule) || $appointment->propose_reschedule->diffInHours(now()) >= 24;

        return view('dashboard.appointment.show', compact('appointment', 'isReschedulePassed'));
    }
}
