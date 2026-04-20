<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Document $document): bool
    {
        // 1. If it's a Public document, anyone can see it
        if ($document->access_level === \App\Enums\AccessLevel::PUBLIC) {
            return true;
        }

        // 2. If it's Internal, only logged-in users with correct roles
        if ($document->access_level === \App\Enums\AccessLevel::INTERNAL) {
            return $user && $user->hasRole([\App\Enums\UserRole::SUPER_ADMIN, \App\Enums\UserRole::ADMIN, \App\Enums\UserRole::PEJABAT]);
        }

        // 3. If it's Restricted, only Admins
        if ($document->access_level === \App\Enums\AccessLevel::RESTRICTED) {
            return $user && $user->hasRole([\App\Enums\UserRole::SUPER_ADMIN, \App\Enums\UserRole::ADMIN]);
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole([\App\Enums\UserRole::SUPER_ADMIN, \App\Enums\UserRole::ADMIN, \App\Enums\UserRole::EDITOR]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Document $document): bool
    {
        return $user->hasRole([\App\Enums\UserRole::SUPER_ADMIN, \App\Enums\UserRole::ADMIN, \App\Enums\UserRole::EDITOR]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
        return $user->hasRole([\App\Enums\UserRole::SUPER_ADMIN, \App\Enums\UserRole::ADMIN]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Document $document): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Document $document): bool
    {
        return false;
    }
}
