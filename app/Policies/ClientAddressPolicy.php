<?php

namespace App\Policies;

use App\Models\ClientAddress;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientAddressPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientaddress_view');
    }
    public function view(User $user, ClientAddress $clientAddress): bool {
        return $user->is_admin || $user->hasPermission('clientaddress_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientaddress_create');
    }
    public function update(User $user, ClientAddress $clientAddress): bool {
        return $user->is_admin || $user->hasPermission('clientaddress_update');
    }
    public function delete(User $user, ClientAddress $clientAddress): bool {
        return $user->is_admin || $user->hasPermission('clientaddress_delete');
    }
    public function restore(User $user, ClientAddress $clientAddress): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, ClientAddress $clientAddress): bool {
        return $user->is_admin;
    }
}
