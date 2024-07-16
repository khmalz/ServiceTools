<?php

namespace App\Actions\Client;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateService
{
    public function handle(User $user, array $data, array $images = []): void
    {
        DB::transaction(function () use ($user, $data, $images) {
            $service = $user->services()->create($data);

            if (!empty($images)) {
                foreach ($images as $image) {
                    $imagePath = $image->store('evidences');

                    $service->images()->create([
                        'path' => $imagePath,
                    ]);
                }
            }

            if ($data['work'] === 'home' && $data['schedule']) {
                $service->appointment()->create([
                    'schedule' => $data['schedule']
                ]);
            }
        });
    }
}
