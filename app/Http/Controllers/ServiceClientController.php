<?php

namespace App\Http\Controllers;

use App\Actions\Client\ActiveService;
use App\Actions\Client\CancelService;
use App\Http\Requests\CancelServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Actions\Client\CreateService;
use App\Actions\Client\UpdateService;
use App\Http\Requests\ActiveServiceRequest;
use App\Http\Requests\ServiceClientRequest;

class ServiceClientController extends Controller
{
    /**
     * Display list service
     */
    public function list(Request $request)
    {
        $services = Service::whereBelongsTo($request->user())->with('user')->get();

        return view('dashboard.service.list', compact('services'));
    }

    /**
     * Display form store data service from client request.
     */
    public function create(Request $request)
    {
        $user = $request->user()->load('client');

        return view('dashboard.service.create', compact('user'));
    }

    /**
     * Store data service from client request.
     */
    public function store(ServiceClientRequest $request, CreateService $action)
    {
        $data = $request->validated();

        try {
            $action->handle($request->user(), $data, $request->file('images') ?? []);

            return to_route('service.create')->with('success', 'Successfully created new service');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display form edit data service from client request.
     */
    public function edit(Request $request, Service $service)
    {
        $service->load('appointment', 'user.client', 'images');

        return view('dashboard.service.edit', compact('service'));
    }

    /**
     * Update data service from client request.
     */
    public function update(ServiceClientRequest $request, Service $service, UpdateService $action)
    {
        $data = $request->validated();

        try {
            $action->handle($service, $data, $request->file('images') ?? []);

            return to_route('service.show', $service)->with('success', 'Successfully updated a service order');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Cancel data service from client request.
     */
    public function cancel(CancelServiceRequest $request, Service $service, CancelService $action)
    {
        $request->validated();

        try {
            $action->handle($service);

            return to_route("service.show", $service)->with('success', 'Successfully cancel a order service');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Active data service from client request.
     */
    public function active(ActiveServiceRequest $request, Service $service, ActiveService $action)
    {
        $request->validated();
        $action->handle($service);

        return to_route("service.show", $service)->with('success', 'Successfully active a order service');
    }
}
