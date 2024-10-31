<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is admin for all authorization.
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->isEditor() || $user->isAuthor();
    }

    /**
     * Determine whether the user can store a post.
     */
    public function store(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor() || $user->isAuthor();
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($post->status !== 'deleted') {
            return $user->isAdmin() || $user->isEditor();
        }
        return true;
    }

    /**
     * Determine whether the user can publish the post.
     */
    public function publish(User $user, Post $post): bool
    {
        if ($post->status !== 'published') {
            return $user->isAdmin() || $user->isEditor();
        }
        return true;
    }
}
