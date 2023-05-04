<?php

namespace App\Policies;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QuotePolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('quote_view');
    }
    public function view(User $user, Quote $quote): bool {
        return $user->is_admin || $user->hasPermission('quote_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('quote_create');
    }
    public function update(User $user, Quote $quote): bool {
        return $user->is_admin || $user->hasPermission('quote_update');
    }
    public function delete(User $user, Quote $quote): bool {
        return $user->is_admin || $user->hasPermission('quote_delete');
    }
    public function restore(User $user, Quote $quote): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Quote $quote): bool {
        return $user->is_admin;
    }
    public function uploadFiles(User $user) {
        return true;
    }
}
