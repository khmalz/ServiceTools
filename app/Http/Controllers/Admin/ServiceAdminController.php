<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceAdminController extends Controller
{
    /**
     * Display a listing of cancel's status order service.
     */
    public function cancel()
    {
        $services = Service::whereStatus('cancel')->with('user')->get();

        return view('dashboard.admin.service.cancel', compact('services'));
    }

    /**
     * Display a listing of pending's status order service.
     */
    public function pending()
    {
        $services = Service::whereStatus('pending')->with('user')->get();

        return view('dashboard.admin.service.pending', compact('services'));
    }

    /**
     * Display a listing of progress's status order service.
     */
    public function progress()
    {
        $services = Service::whereStatus('progress')->with('user')->get();

        return view('dashboard.admin.service.progress', compact('services'));
    }

    /**
     * Display a listing of complete's status order service.
     */
    public function complete()
    {
        $services = Service::whereStatus('complete')->with('user')->get();

        return view('dashboard.admin.service.complete', compact('services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'status' => ['required']
        ]);

        $service->update([
            'status' => $request->status
        ]);

        activity()
            ->performedOn($service)
            ->causedBy($request->user())
            ->withProperties([
                'status' => $request->status,
                'order_id' => $service->order_id
            ])
            ->log('Update Status Service Order');

        return to_route("admin.service.$request->status")->with('success', 'Successfully update status a order service');
    }
}
