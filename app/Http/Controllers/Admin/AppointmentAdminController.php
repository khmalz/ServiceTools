<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technician;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\InboxTechnicianNotification;
use App\Notifications\RescheduleNotification;
use Illuminate\Support\Carbon;

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

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => ['required']
        ]);

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

        return to_route("admin.appointment.$request->status")->with('success', 'Successfully update status a order appointment');
    }

    public function reschedule(Request $request,  Appointment $appointment)
    {
        $request->validate([
            'reschedule' => ['required']
        ]);

        $appointment->update([
            'propose_reschedule' => now()
        ]);

        $request->user()->notify(new RescheduleNotification('client', $appointment->id, $appointment->user->id));

        return to_route('appointment.show', $appointment)->with('success', 'Successfully proposed resechedule an appointment');
    }
}
