<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('invoice_view');
    }
    public function view(User $user, Invoice $invoice): bool {
        return $user->is_admin || $user->hasPermission('invoice_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('invoice_create');
    }
    public function update(User $user, Invoice $invoice): bool {
        return $user->is_admin || $user->hasPermission('invoice_update');
    }
    public function delete(User $user, Invoice $invoice): bool {
        return $user->is_admin || $user->hasPermission('invoice_delete');
    }
    public function restore(User $user, Invoice $invoice): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Invoice $invoice): bool {
        return $user->is_admin;
    }
    public function uploadFiles(User $user) {
        return true;
    }
}
