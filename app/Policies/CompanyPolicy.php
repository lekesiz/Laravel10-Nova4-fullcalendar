<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('company_view');
    }
    public function view(User $user, Company $company): bool {
        return $user->is_admin || $user->hasPermission('company_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('company_create');
    }
    public function update(User $user, Company $company): bool {
        return $user->is_admin || $user->hasPermission('company_update');
    }
    public function delete(User $user, Company $company): bool {
        return $user->is_admin || $user->hasPermission('company_delete');
    }
    public function restore(User $user, Company $company): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Company $company): bool {
        return $user->is_admin;
    }
    public function uploadFiles(User $user) {
        return true;
    }
}
