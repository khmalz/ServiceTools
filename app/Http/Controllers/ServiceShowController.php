<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceShowController extends Controller
{
    /**
     * Show details of a service
     */
    public function __invoke(Request $request, Service $service)
    {
        Gate::denyIf(fn (User $user) => $user->hasRole('client') && $user->id != $service->user_id);

        $service->load('user.client', 'appointment', 'images');

        return view('dashboard.service.show', compact('service'));
    }
}
