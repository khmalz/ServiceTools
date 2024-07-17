<?php

namespace App\Actions\Client;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateProfile
{
    public function handle(User $user, array $data)
    {
        DB::transaction(function () use ($user, $data) {
            if (empty($data['password'])) unset($data['password']);

            $user->update($data);

            $clientData = Arr::only($data, ['telephone', 'gender', 'alamat']);

            if (!empty($clientData)) {
                $user->client()->updateOrCreate([], $clientData);
            }
        });
    }
}
