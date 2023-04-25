<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }
    public function view(User $user, Permission $permission): bool
    {
        return $user->is_admin;
    }
    public function create(User $user): bool
    {
        return $user->is_admin;
    }
    public function update(User $user, Permission $permission): bool
    {
        return $user->is_admin;
    }
    public function delete(User $user, Permission $permission): bool
    {
        return $user->is_admin;
    }
    public function restore(User $user, Permission $permission): bool
    {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Permission $permission): bool
    {
        return $user->is_admin;
    }
}
