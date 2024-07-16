<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Actions\Client\CreateAppointment;
use App\Actions\Client\UpdateAppointment;
use App\Http\Requests\AppointmentRequest;

class AppointmentClientController extends Controller
{
    /**
     * Display list appointment
     */
    public function list(Request $request)
    {
        $appointments = Appointment::forServiceUser($request->user()->id)
            ->with('service.user.client')
            ->get();

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
    public function store(AppointmentRequest $request, Service $service, CreateAppointment $action)
    {
        $data = $request->validated();
        $action->handle($service, $data);

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
    public function update(AppointmentRequest $request, Appointment $appointment, UpdateAppointment $action)
    {
        $data = $request->validated();
        $action->handle($appointment, $data);

        return to_route('appointment.show', $appointment)->with('success', 'Successfully updated a appointment');
    }
}
