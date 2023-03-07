<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenantUuid($uuid, $categories = []);
    public function getProductByUuid($uuid);
    public function getProductsByCategoryUuid($categoryId);
}
