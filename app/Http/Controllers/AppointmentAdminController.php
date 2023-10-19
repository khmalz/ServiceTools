<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Technician;
use Illuminate\Http\Request;

class AppointmentAdminController extends Controller
{
    public function create(Request $request, Appointment $appointment)
    {
        $appointment->load('technicians.user', 'service');
        $technicians = Technician::with('user')->whereNotIn('id', $appointment->technicians->pluck('id'))->get();

        // return $appointment;
        return view('dashboard.admin.appointment.add_technician', compact('appointment', 'technicians'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        $request->validate([
            'technicians' => ['required', 'array', 'min:1'],
            'technicians.*' => ['string']
        ]);

        $appointment->technicians()->sync($request->technicians);

        return to_route('appointment.show', $appointment)->with('success', 'Successfully add/update technician to order');
    }
}
