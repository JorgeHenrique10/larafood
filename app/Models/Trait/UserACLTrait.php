<?php

namespace App\Models\Trait;

use App\Models\Tenant;
use App\Models\User;

trait UserACLTrait
{
    public function permissions(): array
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];

        foreach ($permissionsRole as $permission) {
            if (in_array($permission, $permissionsPlan))
                array_push($permissions, $permission);
        }
        return $permissions;
    }
    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();
        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }
    public function permissionsPlan(): array
    {
        $tenant =  Tenant::with('plan.profiles.permissions')->where('id', $this->tenant->id)->first();

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
