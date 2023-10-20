<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Technician;
use Illuminate\Http\Request;

class AppointmentAdminController extends Controller
{
    /**
     * Display a listing of pending's status order appointment.
     */
    public function pending(Request $request)
    {
        $user  = $request->user();

        $appointments = Appointment::whereStatus('pending')->with('service.user')->when($user->hasRole('technician'), function ($query) use ($user) {
            $query->whereHas('technicians', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->get();

        return view('dashboard.admin.appointment.pending', compact('appointments'));
    }

    /**
     * Display a listing of progress's status order appointment.
     */
    public function progress(Request $request)
    {
        $user  = $request->user();

        $appointments = Appointment::whereStatus('progress')->with('service.user')->when($user->hasRole('technician'), function ($query) use ($user) {
            $query->whereHas('technicians', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->get();

        return view('dashboard.admin.appointment.progress', compact('appointments'));
    }

    /**
     * Display a listing of complete's status order appointment.
     */
    public function complete(Request $request)
    {
        $user  = $request->user();

        $appointments = Appointment::whereStatus('complete')->with('service.user')->when($user->hasRole('technician'), function ($query) use ($user) {
            $query->whereHas('technicians', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->get();

        return view('dashboard.admin.appointment.complete', compact('appointments'));
    }

    public function create(Request $request, Appointment $appointment)
    {
        $appointment->load('technicians.user', 'appointment');
        $technicians = Technician::with('user')->whereNotIn('id', $appointment->technicians->pluck('id'))->get();

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

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => ['required']
        ]);

        $appointment->update([
            'status' => $request->status
        ]);

        return to_route("admin.appointment.$request->status")->with('success', 'Successfully update status a order appointment');
    }
}
