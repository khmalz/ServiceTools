<?php

namespace App\Actions\Client;

use App\Models\Service;

class CreateAppointment
{
    public function handle(Service $service, array $data)
    {
        $service->appointment()->create([
            'schedule' => $data['schedule']
        ]);
    }
}
