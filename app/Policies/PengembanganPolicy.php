<?php

namespace App\Policies;

use App\Models\Pengembangan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengembanganPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return in_array($user->role_id, [1, 2]);
    }

    public function view(User $user)
    {
        return in_array($user->role_id, [1]);
    }

    public function create(User $user)
    {
        return in_array($user->role_id, [1, 3]);
    }

    public function update(User $user)
    {
        return in_array($user->role_id, [1, 2]);
    }

    public function delete(User $user)
    {
        return in_array($user->role_id, [1]);
    }

    public function viewReport(User $user)
    {
        return in_array($user->role_id, [1]);
    }
}
