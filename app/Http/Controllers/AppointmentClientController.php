<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
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
     * Display form store data service from client request.
     */
    public function create(Service $service)
    {
        if ($service->appointment) {
            return to_route('appointment.edit', $service->appointment);
        }

        $service->load('user.client');

        return view('dashboard.appointment.create', compact('service'));
    }

    /**
     * Store data service from client request.
     */
    public function store(Request $request, Service $service)
    {
        $request->validate([
            'schedule' => ['required']
        ]);

        $service->appointment()->create([
            'schedule' => $request->schedule
        ]);

        return to_route('appointment.show', $service->appointment)->with('success', 'Successfully created a appointment');
    }

    /**
     * Display form update data appointment from client request.
     */
    public function edit(Appointment $appointment)
    {
        $appointment->load('service.user.client');

        return view('dashboard.appointment.edit', compact('appointment'));
    }

    /**
     * Update data appointment from client request.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'schedule' => ['required']
        ]);

        $appointment->update([
            'schedule' => $request->schedule
        ]);

        return to_route('appointment.show', $appointment)->with('success', 'Successfully updated a appointment');
    }
}
