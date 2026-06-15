<?php

namespace App\Actions\Profile;

use App\Models\User;

class UpdatePasswordAction
{
    public function execute(User $user, string $password): void
    {
        $user->update(['password' => $password]);
    }
}
