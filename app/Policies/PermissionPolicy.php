<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('permission_view');
    }
    public function view(User $user, Permission $permission): bool {
        return $user->is_admin || $user->hasPermission('permission_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('permission_create');
    }
    public function update(User $user, Permission $permission): bool {
        return $user->is_admin || $user->hasPermission('permission_update');
    }
    public function delete(User $user, Permission $permission): bool {
        return false;
    }
    public function restore(User $user, Permission $permission): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Permission $permission): bool {
        return $user->is_admin;
    }
}
