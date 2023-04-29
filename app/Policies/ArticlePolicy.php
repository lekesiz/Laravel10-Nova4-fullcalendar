<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function viewAny(User $user): bool {
        return $user->is_admin || $user->hasPermission('article_view');
    }
    public function view(User $user, Article $article): bool {
        return $user->is_admin || $user->hasPermission('article_view');
    }
    public function create(User $user): bool {
        return $user->is_admin || $user->hasPermission('article_create');
    }
    public function update(User $user, Article $article): bool {
        return $user->is_admin || $user->hasPermission('article_update');
    }
    public function delete(User $user, Article $article): bool {
        return $user->is_admin || $user->hasPermission('article_delete');
    }
    public function restore(User $user, Article $article): bool {
        return $user->is_admin;
    }
    public function forceDelete(User $user, Article $article): bool {
        return $user->is_admin;
    }
}
