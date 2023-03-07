<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    private $entity;
    public function __construct(Tenant $tenant)
    {
        $this->entity = $tenant;
    }

    public function getAllTenants(int $per_page)
    {
        return $this->entity->paginate($per_page);
    }

    public function getTenantByUuid($uuid)
    {
        return $this->entity->query()->where('id', $uuid)->first();
    }
}
