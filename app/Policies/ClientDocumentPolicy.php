<?php

namespace App\Policies;

use App\Models\ClientDocument;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientDocumentPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientdocument_view');
    }
    public function view(User $user, ClientDocument $clientDocument): bool {
        return $user->is_admin || $user->hasPermission('clientdocument_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('clientdocument_create');
    }
    public function update(User $user, ClientDocument $clientDocument): bool {
        return $user->is_admin || $user->hasPermission('clientdocument_update');
    }
    public function delete(User $user, ClientDocument $clientDocument): bool {
        return $user->is_admin || $user->hasPermission('clientdocument_delete');
    }
    public function restore(User $user, ClientDocument $clientDocument): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, ClientDocument $clientDocument): bool {
        return $user->is_admin;
    }
    public function uploadFiles(User $user) {
        return true;
    }
}
