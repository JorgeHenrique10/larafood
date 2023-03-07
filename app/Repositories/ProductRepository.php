<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private string $table = 'products')
    {
    }
    public function getProductsByTenantUuid($uuid, $categories = [])
    {
        return DB::table($this->table)
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('categories.tenant_id', $uuid)
            ->where('products.tenant_id', $uuid)
            ->where(function ($query) use ($categories) {
                if ($categories != []) {
                    $query->whereIn('categories.id', $categories);
                }
            })
            ->get();
    }
    public function getProductByUuid($uuid)
    {
        return DB::table($this->table)
            ->where('id', $uuid)
            ->first();
    }
    public function getProductsByCategoryUuid($categoryId)
    {
        return DB::table($this->table)
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('categories.id', $categoryId)
            ->select('products.*')
            ->get();
    }
}
