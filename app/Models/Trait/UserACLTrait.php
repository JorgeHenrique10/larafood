<?php

namespace App\Models\Trait;

trait UserACLTrait
{
    public function permissions()
    {
        $tenant = $this->tenant;
        $plan = $tenant->plan;
        $profiles = $plan->profiles;

        $permissions = [];

        foreach ($profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }

    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }
    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }
}
