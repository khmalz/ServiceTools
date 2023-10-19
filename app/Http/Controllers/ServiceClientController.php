<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function update(ServiceClientRequest $request, Service $service)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $service->update($data);

            $deleted = $request->img_deleted;

            if ($deleted) {
                ServiceImage::destroy($deleted);
            }

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
                $service->appointment()->updateOrCreate(
                    [],
                    [
                        'schedule' => $request->schedule
                    ]
                );
            } else {
                $service->appointment()->delete();
            }

            DB::commit();

            return to_route('service.show', $service)->with('success', 'Successfully updated a service order');
        } catch (\Exception $e) {
            // Rollback database transaksi jika terjadi error
            DB::rollback();

            return back()->with('error', 'Failed to save changes: ' . $e->getMessage());
        }
    }
}
