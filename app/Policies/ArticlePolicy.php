<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user !== null;
    }

    public function view(User $user, Article $article): bool
    {
        return $article->published_at !== null || $user->id === $article->user_id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('author');
    }

    public function update(User $user, Article $article): bool
    {
        return $user->hasRole('author') && $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->hasRole('admin');
    }

    public function publish(User $user): bool
    {
        return $user->hasRole('editor') || $user->hasRole('admin');
    }
}
