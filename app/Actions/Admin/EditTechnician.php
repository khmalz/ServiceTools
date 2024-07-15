<?php

namespace App\Actions\Admin;

use App\Models\User;

class EditTechnician
{
    public function handle(User $user, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
    }
}
