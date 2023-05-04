<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('client_view');
    }
    public function view(User $user, Client $client): bool {
        return $user->is_admin || $user->hasPermission('client_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('client_create');
    }
    public function update(User $user, Client $client): bool {
        return $user->is_admin || $user->hasPermission('client_update');
    }
    public function delete(User $user, Client $client): bool {
        return $user->is_admin || $user->hasPermission('client_delete');
    }
    public function restore(User $user, Client $client): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Client $client): bool {
        return $user->is_admin;
    }
    public function uploadFiles(User $user) {
        return true;
    }
}
