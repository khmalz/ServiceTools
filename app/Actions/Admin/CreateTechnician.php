<?php

namespace App\Actions\Admin;

use App\Models\User;

class CreateTechnician
{
    public function handle(array $data)
    {
        $user = User::create($data);

        $user->assignRole('technician');

        $user->technician()->create();
    }
}
