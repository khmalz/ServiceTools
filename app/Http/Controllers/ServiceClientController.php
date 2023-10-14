<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceClientRequest;
use App\Models\Service;
use Illuminate\Http\Request;

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
    public function store(ServiceClientRequest $request)
    {
        $data = $request->validated();

        $service = $request->user()->services()->create($data);

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $imagePath = $image->store('evidences');

                $service->images()->create([
                    'path' => $imagePath,
                ]);
            }
        }

        if ($request->work == 'home' && $request->has('schedule')) {
            $service->appointment()->create([
                'schedule' => $request->schedule
            ]);
        }

        return to_route('service.create')->with('success', 'Successfully created new service');
    }

    /**
     * Show details of a service
     */
    public function show(Service $service)
    {
        return view('dashboard.service.show', compact('service'));
    }
}
