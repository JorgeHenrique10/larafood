<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductService
{

    public function __construct(
        private ProductRepositoryInterface $repositoryProduct,
        private CategoryRepositoryInterface $repositoryCategory
    ) {
    }

    public function getProductsByTenantUuid($uuid, array $categories = [])
    {
        return $this->repositoryProduct->getProductsByTenantUuid($uuid, $categories);
    }

    public function getProductByUuid($uuid)
    {
        return $this->repositoryProduct->getProductByUuid($uuid);
    }

    public function getProductsByCategoryUuid($categoryId)
    {
        $products = $this->repositoryProduct->getProductsByCategoryUuid($categoryId);

        return $products;
    }
}
