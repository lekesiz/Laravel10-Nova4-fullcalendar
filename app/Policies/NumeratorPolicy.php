<?php

namespace App\Policies;

use App\Models\Numerator;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NumeratorPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('numerator_view');
    }
    public function view(User $user, Numerator $numerator): bool {
        return $user->is_admin || $user->hasPermission('numerator_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('numerator_create');
    }
    public function update(User $user, Numerator $numerator): bool {
        return $user->is_admin || $user->hasPermission('numerator_update');
    }
    public function delete(User $user, Numerator $numerator): bool {
        return $user->is_admin || $user->hasPermission('numerator_delete');
    }
    public function restore(User $user, Numerator $numerator): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Numerator $numerator): bool {
        return $user->is_admin;
    }
}
