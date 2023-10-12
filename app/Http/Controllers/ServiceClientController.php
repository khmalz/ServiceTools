<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceClientRequest;
use Illuminate\Http\Request;

class ServiceClientController extends Controller
{
    /**
     * Display form store data service from client request.
     */
    public function create()
    {
        return view('dashboard.service.create');
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

        return to_route('service.create')->with('success', 'Successfully created new service');
    }
}
