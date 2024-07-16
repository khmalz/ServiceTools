<?php

namespace App\Actions\Client;

use App\Models\Service;

class ActiveService
{
    public function handle(Service $service)
    {
        $service->update([
            'status' => "pending"
        ]);
    }
}
