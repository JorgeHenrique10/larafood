<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\Api\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index(TenantFormRequest $request)
    {

        $categories = $request->get('categories', []);
        $products = $this->productService->getProductsByTenantUuid($request->get('tenant_id'), $categories);
        return ProductResource::collection($products);
    }

    public function show(TenantFormRequest $request, $uuid)
    {
        $product = $this->productService->getProductByUuid($uuid);
        if (!$product) {
            return response()->json(['message' => 'Product Not Found!'], 404);
        }
        return new ProductResource($product);
    }

    public function productsCategory(ProductRequest $request)
    {

        $products = $this->productService->getProductsByCategoryUuid($request->only('category_id'));

        return ProductResource::collection($products);
    }
}
