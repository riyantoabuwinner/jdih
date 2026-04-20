<?php

namespace App\Traits;

use App\Enums\UserRole;
use App\Models\Role;

trait HasRole
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string|array|UserRole $role): bool
    {
        if ($role instanceof UserRole) {
            $role = $role->value;
        }

        if (is_array($role)) {
            return in_array($this->role?->name, $role);
        }

        return $this->role?->name === $role;
    }

    public function isImpersonated(): bool
    {
        return session()->has('impersonator_id');
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(UserRole::SUPER_ADMIN);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole([UserRole::SUPER_ADMIN->value, UserRole::ADMIN->value]);
    }
}
