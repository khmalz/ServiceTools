<?php

namespace App\Actions\Admin;

use App\Models\Service;
use Illuminate\Http\Request;

class UpdateService
{
    public function handle(Service $service, Request $request)
    {
        $service->update([
            'status' => $request->status
        ]);

        activity()
            ->performedOn($service)
            ->causedBy($request->user)
            ->withProperties([
                'status' => $request->status,
                'order_id' => $service->order_id
            ])
            ->log('Update Status Service Order');
    }
}
