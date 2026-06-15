<?php

namespace App\Actions\Profile;

use App\Models\User;

class UpdateProfileAction
{
    public function execute(User $user, array $data): void
    {
        $user->update($data);
    }
}
