<?php

namespace App\Repositories\Contracts;

use App\Models\Tenant;

interface TenantRepositoryInterface
{
    public function getAllTenants(int $per_page);
    public function getTenantByUuid($uuid);
}
