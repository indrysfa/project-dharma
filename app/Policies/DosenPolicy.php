<?php

namespace App\Policies;

use App\Models\Dosen;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DosenPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return in_array($user->role_id, [2, 3]);
    }

    public function view(User $user)
    {
        return in_array($user->role_id, [1, 2, 3]);
    }

    public function create(User $user)
    {
        return in_array($user->role_id, [1]);
    }

    public function update(User $user)
    {
        return in_array($user->role_id, [1, 2, 3]);
    }

    public function delete(User $user)
    {
        return in_array($user->role_id, [1]);
    }
}
