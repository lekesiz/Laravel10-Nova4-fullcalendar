<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('task_view');
    }
    public function view(User $user, Task $task): bool {
        return $user->is_admin || $user->hasPermission('task_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('task_create');
    }
    public function update(User $user, Task $task): bool {
        return $user->is_admin || $user->hasPermission('task_update');
    }
    public function delete(User $user, Task $task): bool {
        return $user->is_admin || $user->hasPermission('task_delete');
    }
    public function restore(User $user, Task $task): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Task $task): bool {
        return $user->is_admin;
    }
}
