<?php

namespace App\Policies;

use App\Models\CreditNote;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CreditNotePolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('creditnote_view');
    }
    public function view(User $user, CreditNote $creditNote): bool {
        return $user->is_admin || $user->hasPermission('creditnote_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('creditnote_create');
    }
    public function update(User $user, CreditNote $creditNote): bool {
        return $user->is_admin || $user->hasPermission('creditnote_update');
    }
    public function delete(User $user, CreditNote $creditNote): bool {
        return $user->is_admin || $user->hasPermission('creditnote_delete');
    }
    public function restore(User $user, CreditNote $creditNote): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, CreditNote $creditNote): bool {
        return $user->is_admin;
    }
}
