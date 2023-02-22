<?php

namespace App\Observers;

use App\Models\RolePermission;
use Illuminate\Support\Str;

class RolePermissionObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\RolePermission  $rolePermission
     * @return void
     */
    public function creating(RolePermission $rolePermission)
    {
        $rolePermission->id = Str::uuid();
    }
}
