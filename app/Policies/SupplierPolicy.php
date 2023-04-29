<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('supplier_view');
    }
    public function view(User $user, Supplier $supplier): bool {
        return $user->is_admin || $user->hasPermission('supplier_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('supplier_create');
    }
    public function update(User $user, Supplier $supplier): bool {
        return $user->is_admin || $user->hasPermission('supplier_update');
    }
    public function delete(User $user, Supplier $supplier): bool {
        return $user->is_admin || $user->hasPermission('supplier_delete');
    }
    public function restore(User $user, Supplier $supplier): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Supplier $supplier): bool {
        return $user->is_admin;
    }
}
