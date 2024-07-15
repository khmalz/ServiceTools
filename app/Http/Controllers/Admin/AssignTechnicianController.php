<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\AssignTechnician;
use Carbon\Carbon;
use App\Models\Technician;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignTechnicianRequest;

class AssignTechnicianController extends Controller
{
    public function index(Request $request, Appointment $appointment)
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

        return view('dashboard.admin.appointment.assign_technician', compact('appointment', 'technicians'));
    }

    public function store(AssignTechnicianRequest $request, Appointment $appointment, AssignTechnician $action)
    {
        $request->validated();
        $action->handle($appointment, $request);

        return to_route('appointment.show', $appointment)->with('success', 'Successfully assign technician to an order');
    }
}
