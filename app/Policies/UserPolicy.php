<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('user_view');
    }
    public function view(User $user, User $model): bool {
        return $user->is_admin || $user->hasPermission('user_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('user_create');
    }
    public function update(User $user, User $model): bool {
        if ($user->id === $model->id) {
            return true;
        }
        return $user->is_admin || $user->hasPermission('user_update');
    }
    public function delete(User $user, User $model): bool {
        return $user->is_admin || $user->hasPermission('user_delete');
    }
    public function restore(User $user, User $model): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, User $model): bool {
        return $user->is_admin;
    }
    public function uploadFiles(User $user) {
        return true;
    }
}
