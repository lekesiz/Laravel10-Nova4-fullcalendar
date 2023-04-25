<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }
    public function view(User $user, User $model): bool
    {
        return $user->is_admin;
    }
    public function create(User $user): bool
    {
        return $user->is_admin;
    }
    public function update(User $user, User $model): bool
    {
        return $user->is_admin;
    }
    public function delete(User $user, User $model): bool
    {
        return $user->is_admin;
    }
    public function restore(User $user, User $model): bool
    {
        return $user->is_admin;
    }
    public function forceDelete(User $user, User $model): bool
    {
        return $user->is_admin;
    }
}