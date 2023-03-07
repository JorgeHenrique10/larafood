<?php

namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TableService
{
    private $repository;


    public function __construct(TableRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getTablesByTenantUuid($uuid)
    {
        return $this->repository->getTablesByTenantUuid($uuid);
    }

    public function getTableByUuid($uuid)
    {
        return $this->repository->getTableByUuid($uuid);
    }
}
