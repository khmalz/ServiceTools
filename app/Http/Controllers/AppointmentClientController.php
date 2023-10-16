<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentClientController extends Controller
{
    /**
     * Display list appointment
     */
    public function list(Request $request)
    {
        $appointments = Appointment::with('service.user.client')->get();

        return view('dashboard.appointment.list', compact('appointments'));
    }

    /**
     * Show details of a appointment
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('service.user.client', 'service.images');

        return view('dashboard.appointment.show', compact('appointment'));
    }
}
