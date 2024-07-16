<?php

namespace App\Actions\Client;

use App\Models\Service;
use Illuminate\Support\Facades\DB;

class CancelService
{
    public function handle(Service $service)
    {
        DB::transaction(function () use ($service) {
            $service->update([
                'status' => "cancel"
            ]);

            if ($service->appointment) {
                $service->appointment()->delete();
            }
        });
    }
}
