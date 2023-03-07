<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantServiceApi
{
    private $repository;


    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTenants(int $per_page)
    {
        return $this->repository->getAllTenants($per_page);
    }

    public function getTenantByUuid($uuid)
    {
        return $this->repository->getTenantByUuid($uuid);
    }
}
