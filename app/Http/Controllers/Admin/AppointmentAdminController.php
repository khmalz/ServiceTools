<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technician;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\InboxTechnicianNotification;
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

    public function create(Request $request, Appointment $appointment)
    {
        $appointment->load('technicians.user', 'service');
        $technicians = Technician::with('user', 'appointments:id,schedule')->whereNotIn('id', $appointment->technicians->pluck('id'))->get();

        $schedule = $appointment->schedule;
        $startTime = $schedule->subHours(3);
        $endTime = $schedule->addHours(3);

        // Lakukan perulangan untuk setiap Technician
        foreach ($technicians as $technician) {
            // Lakukan pengecekan apakah Technician memiliki jadwal yang berdekatan
            $isConflict = $technician->appointments->contains(function ($appointmentItem) use ($startTime, $endTime) {
                $apptTime = Carbon::parse($appointmentItem->schedule);
                return $apptTime->copy()->subHours(3)->isBefore($endTime) && $apptTime->copy()->addHours(3)->isAfter($startTime);
            });

            // Jika ada konflik, tandai Technician sebagai nonaktif
            $technician->disabled = $isConflict;
        }

        return view('dashboard.admin.appointment.add_technician', compact('appointment', 'technicians'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        $request->validate([
            'technicians' => [
                'required', 'array', 'min:1',
                function ($attribute, $value, $fail) use ($appointment) {
                    // Pengecekan rentang waktu 3 jam sebelum dan sesudah
                    $startTime = $appointment->schedule->copy()->subHours(3);
                    $endTime = $appointment->schedule->copy()->addHours(3);
                    $conflict = Technician::whereIn('id', $value)
                        ->whereHas('appointments', function ($query) use ($startTime, $endTime) {
                            $query->where(function ($query) use ($startTime, $endTime) {
                                $query->where('schedule', '>=', $startTime)
                                    ->where('schedule', '<=', $endTime);
                            });
                        })
                        ->count();

                    if ($conflict > 0) {
                        $fail('Choose a technician who is available within 3 hours before and after the scheduled appointment.');
                    }
                },
            ],
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

        foreach ($request->technicians as $technician_id) {
            $technician = Technician::find($technician_id);
            $technician->user->notify(new InboxTechnicianNotification('admin', $appointment->service->id, $appointment->schedule, $appointment->status));
        }

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
