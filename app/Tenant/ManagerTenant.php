<?php

namespace App\Tenant;

use Illuminate\Support\Facades\Auth;

class ManagerTenant
{
    public function getUuidTenant()
    {
        return  Auth::check() ? Auth::user()->tenant_id : '';
    }

    public function getTenant()
    {
        return Auth::check() ? Auth::user()->tenant : '';
    }

    public function isAdmin(): bool
    {
        return in_array(Auth::user()->email, config('tenant.admins'));
    }
}
