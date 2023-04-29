<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('payment_view');
    }
    public function view(User $user, Payment $payment): bool {
        return $user->is_admin || $user->hasPermission('payment_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('payment_create');
    }
    public function update(User $user, Payment $payment): bool {
        return $user->is_admin || $user->hasPermission('payment_update');
    }
    public function delete(User $user, Payment $payment): bool {
        return $user->is_admin || $user->hasPermission('payment_delete');
    }
    public function restore(User $user, Payment $payment): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Payment $payment): bool {
        return $user->is_admin;
    }
}
