<?php

namespace App\Policies;

use App\Models\Pengabdian;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengabdianPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return in_array($user->role_id, [1, 2]);
    }

    public function view(User $user)
    {
        return in_array($user->role_id, [1, 2, 3]);
    }

    public function create(User $user)
    {
        return in_array($user->role_id, [1, 2]);
    }

    public function update(User $user)
    {
        return in_array($user->role_id, [1, 2, 3]);
    }

    public function delete(User $user)
    {
        return in_array($user->role_id, [1]);
    }

    public function viewReport(User $user)
    {
        return in_array($user->role_id, [1]);
    }

    public function aktif(User $user)
    {
        return in_array($user->status, [1]);
    }
}
