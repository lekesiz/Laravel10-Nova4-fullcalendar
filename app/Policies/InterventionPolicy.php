<?php

namespace App\Policies;

use App\Models\Intervention;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InterventionPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('intervention_view');
    }
    public function view(User $user, Intervention $intervention): bool {
        return $user->is_admin || $user->hasPermission('intervention_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('intervention_create');
    }
    public function update(User $user, Intervention $intervention): bool {
        return $user->is_admin || $user->hasPermission('intervention_update');
    }
    public function delete(User $user, Intervention $intervention): bool {
        return $user->is_admin || $user->hasPermission('intervention_delete');
    }
    public function restore(User $user, Intervention $intervention): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Intervention $intervention): bool {
        return $user->is_admin;
    }
}
