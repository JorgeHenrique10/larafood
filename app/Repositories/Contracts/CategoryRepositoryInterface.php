<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantUuid($uuid);
    // public function getCategoryByUuid($uuid);
    public function getCategoryByUuid($uuid);
}
