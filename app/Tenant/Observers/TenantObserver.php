<?php

namespace App\Tenant\Observers;

use App\Models\Tenant;
use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TenantObserver
{

    public function creating(Model $model)
    {
        $managerTenant = app(ManagerTenant::class);
        $identity = $managerTenant->getUuidTenant();

        if ($identity) {
            $model->tenant_id = $identity;
        }

        $model->id = (string) Str::uuid();
        if ((in_array('url', $model->getFillable())))
            $model->url = Str::kebab($model->name);
    }

    public function updating(Tenant $tenant)
    {
        $tenant->url = Str::kebab($tenant->name);
    }
}
