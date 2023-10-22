<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $activities = Activity::with('causer', 'subject')->latest()->paginate(10);

        return view('dashboard.admin.activity', compact('activities'));
    }
}
