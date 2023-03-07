<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryService
{
    private $repository;


    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getCategoriesByTenantUuid($uuid)
    {
        return $this->repository->getCategoriesByTenantUuid($uuid);
    }

    public function getCategoryByUuid($uuid)
    {
        return $this->repository->getCategoryByUuid($uuid);
    }
}
