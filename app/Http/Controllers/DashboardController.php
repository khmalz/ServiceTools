<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technician;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasRole('client')) {
            $user = $request->user()->load('client');

            return view('dashboard.index', compact('user'));
        }

        $serviceCount = Service::whereNotCancel()->count();
        $appointmentCount = Appointment::count();
        $technicianCount = Technician::count();

        return view('dashboard.index', compact('serviceCount', 'appointmentCount', 'technicianCount'));
    }
}
