<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technician;
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
        $appointment->load('technicians.user', 'service');
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

        activity()
            ->performedOn($appointment)
            ->causedBy($request->user())
            ->withProperties([
                'status' => "assign",
                'order_id' => $appointment->service->order_id
            ])
            ->log('Assign Appointment Task for Technician');

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
}
