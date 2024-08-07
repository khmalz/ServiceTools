<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AppointmentShowController extends Controller
{
    /**
     * Show details of a appointment
     */
    public function __invoke(Request $request, Appointment $appointment)
    {
        Gate::denyIf(fn (User $user) => $user->hasRole('client') && $user->id != $appointment->user->id);

        $appointment->load('service.user.client', 'service.images', 'technicians.user:id,name');

        /**
         * Pengajuan reschedule null, boleh
         * Pengajuan reschedule lebih dari 24 jam, boleh
         * Pengajuan reschedule kurang dari 24 jam, tidak boleh
         * Jika status appointment pending, tidak boleh
         */
        $isReschedulePassed = $appointment->status == 'pending' && (is_null($appointment->propose_reschedule) || $appointment->propose_reschedule->diffInHours(now()) >= 24);

        return view('dashboard.appointment.show', compact('appointment', 'isReschedulePassed'));
    }
}
