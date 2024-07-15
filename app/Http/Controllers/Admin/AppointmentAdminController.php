<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\RescheduleAppointment;
use App\Actions\Admin\UpdateAppointment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentAdminController extends Controller
{
    /**
     * Display a listing of pending's status order appointment.
     */
    public function pending(Request $request)
    {
        $user  = $request->user();

        $appointments = Appointment::whereStatus('pending')->with('service.user')
            ->when($user->hasRole('technician'), function ($query) use ($user) {
                $query->forTechnicianUser($user->id);
            })
            ->get();

        return view('dashboard.admin.appointment.pending', compact('appointments'));
    }

    /**
     * Display a listing of progress's status order appointment.
     */
    public function progress(Request $request)
    {
        $user  = $request->user();

        $appointments = Appointment::whereStatus('progress')->with('service.user')
            ->when($user->hasRole('technician'), function ($query) use ($user) {
                $query->forTechnicianUser($user->id);
            })
            ->get();

        return view('dashboard.admin.appointment.progress', compact('appointments'));
    }

    /**
     * Display a listing of complete's status order appointment.
     */
    public function complete(Request $request)
    {
        $user  = $request->user();

        $appointments = Appointment::whereStatus('complete')->with('service.user')
            ->when($user->hasRole('technician'), function ($query) use ($user) {
                $query->forTechnicianUser($user->id);
            })
            ->get();

        return view('dashboard.admin.appointment.complete', compact('appointments'));
    }

    public function update(Request $request, Appointment $appointment, UpdateAppointment $action)
    {
        $request->validate([
            'status' => ['required']
        ]);
        $action->handle($appointment, $request);

        return to_route("admin.appointment.$request->status")->with('success', 'Successfully update status a order appointment');
    }

    public function reschedule(Request $request,  Appointment $appointment, RescheduleAppointment $action)
    {
        $request->validate([
            'reschedule' => ['required']
        ]);
        $action->handle($appointment, $request);

        return to_route('appointment.show', $appointment)->with('success', 'Successfully proposed resechedule an appointment');
    }
}
