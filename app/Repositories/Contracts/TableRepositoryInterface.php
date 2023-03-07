<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTablesByTenantUuid($uuid);
    public function getTableByUuid($uuid);
}
