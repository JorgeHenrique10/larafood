<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private Product $product)
    {
    }
    public function getProductsByTenantUuid($uuid, $categories = [])
    {
        // return DB::table($this->table)
        //     ->join('category_product', 'category_product.product_id', '=', 'products.id')
        //     ->join('categories', 'categories.id', '=', 'category_product.category_id')
        //     ->where('categories.tenant_id', $uuid)
        //     ->where('products.tenant_id', $uuid)
        //     ->where(function ($query) use ($categories) {
        //         if ($categories != []) {
        //             $query->whereIn('categories.id', $categories);
        //         }
        //     })
        //     ->select('products.*')
        //     ->get();

        $products = $this->product->with('categories')
            ->where('tenant_id', $uuid)
            ->where(function ($query) use ($categories) {
                if ($categories != []) {
                    $query->whereIn('categories.id', $categories);
                }
            })
            ->get();

        return $products;
    }
    public function getProductByUuid($uuid)
    {
        return DB::table('products')
            ->where('id', $uuid)
            ->first();
    }
    public function getProductsByCategoryUuid($categoryId)
    {
        return DB::table('products')
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('categories.id', $categoryId)
            ->select('products.*')
            ->get();
    }
}
