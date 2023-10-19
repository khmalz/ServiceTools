<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceShowController extends Controller
{
    /**
     * Show details of a service
     */
    public function __invoke(Request $request, Service $service)
    {
        $service->load('user.client', 'appointment', 'images');

        return view('dashboard.service.show', compact('service'));
    }
}
