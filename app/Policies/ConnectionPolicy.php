<?php

namespace App\Policies;

use App\Models\Connection;
use App\Models\User;

class ConnectionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update (User $user,Connection $connection):bool
    {
        return $user->id === $connection->user_id;
    }
}
