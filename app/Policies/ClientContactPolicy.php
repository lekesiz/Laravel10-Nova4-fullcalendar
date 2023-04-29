<?php

namespace App\Policies;

use App\Models\ClientContact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientContactPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientcontact_view');
    }
    public function view(User $user, ClientContact $clientContact): bool {
        return $user->is_admin || $user->hasPermission('clientcontact_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientcontact_create');
    }
    public function update(User $user, ClientContact $clientContact): bool {
        return $user->is_admin || $user->hasPermission('clientcontact_update');
    }
    public function delete(User $user, ClientContact $clientContact): bool {
        return $user->is_admin || $user->hasPermission('clientcontact_delete');
    }
    public function restore(User $user, ClientContact $clientContact): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, ClientContact $clientContact): bool {
        return $user->is_admin;
    }
}
