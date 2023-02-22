<?php

namespace App\Listeners;

use App\Events\TenantCreated;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\RoleUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class AddRoleTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TenantCreated  $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        $role = Role::create(['name' => 'Admin']);

        $profiles = $event->getTenant()->plan->profiles;

        foreach ($profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                RolePermission::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission->id
                ]);
                // $role->permissions()->attach([
                //     'id' => Str::uuid(),
                //     $permission,
                // ]);
            }
        }


        $user = $event->getUser();
        RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
        // $user->roles()->attach([
        //     'id' => Str::uuid(),
        //     'role_id' => $role->id
        // ]);

        return true;
    }
}
