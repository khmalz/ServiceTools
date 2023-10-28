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

        return view('dashboard.appointment.show', compact('appointment'));
    }
}
