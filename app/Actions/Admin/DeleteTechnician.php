<?php

namespace App\Actions\Admin;

use App\Models\User;

class DeleteTechnician
{
    public function handle(User $user)
    {
        $user->delete();
    }
}
