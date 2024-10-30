<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can update the user.
     */
    public function update(User $current_user, User $user): bool
    {
        return $current_user->id === $user->id;
    }

    /**
     * Determine whether the user can approve the role request.
     */
    public function approveRole(User $user, string $roleName): bool
    {
        if ($roleName === Role::ROLE_AUTHOR) {
            return $user->hasRole(Role::ROLE_EDITOR) || $user->hasRole(Role::ROLE_ADMIN);
        }
        if ($roleName === Role::ROLE_EDITOR) {
            return $user->hasRole(Role::ROLE_ADMIN);
        }
        return false;
    }
}
