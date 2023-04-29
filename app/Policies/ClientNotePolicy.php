<?php

namespace App\Policies;

use App\Models\ClientNote;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientNotePolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientnote_view');
    }
    public function view(User $user, ClientNote $clientNote): bool {
        return $user->is_admin || $user->hasPermission('clientnote_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientnote_create');
    }
    public function update(User $user, ClientNote $clientNote): bool {
        return $user->is_admin || $user->hasPermission('clientnote_update');
    }
    public function delete(User $user, ClientNote $clientNote): bool {
        return $user->is_admin || $user->hasPermission('clientnote_delete');
    }
    public function restore(User $user, ClientNote $clientNote): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, ClientNote $clientNote): bool {
        return $user->is_admin;
    }
}
