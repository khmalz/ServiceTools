<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalenderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $events = [];

        $appointments = Appointment::with('service.user.client')->get();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => "Fix tools in " . $appointment->service->user->name . "'s house at " . $appointment->service->user->client->alamat,
                'appoin_id' => $appointment->id,
                'service_id' => $appointment->service->order_id,
                'start' => $appointment->schedule,
            ];
        }

        return view('dashboard.admin.calender', compact('events'));
    }
}
