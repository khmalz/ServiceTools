<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceClientRequest;
use Illuminate\Http\Request;

class ServiceClientController extends Controller
{
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

        return to_route('home')->with('success', 'Successfully created new service');
    }
}
