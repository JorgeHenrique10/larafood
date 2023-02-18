<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryProductController extends Controller
{
    public function __construct(private Category $category, private Product $product)
    {
        $this->middleware(['can:category']);
    }

    public function categories($id)
    {
        $product = $this->product->query()->with('categories')->findOrFail($id);

        if (!$product)
            return redirect()->back();

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.index', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function products($id)
    {
        $category = $this->category->query()->with('products')->findOrFail($id);

        if (!$category)
            return redirect()->back();

        $products = $category->products()->paginate();

        return view('admin.pages.products.categories.products.index', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function available(Request $request, $id)
    {
        $product = $this->product->query()->with('categories')->findOrFail($id);

        if (!$product)
            return redirect()->back();

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        if (!$filters) {
            $filters = [];
            $filters['filter'] = '';
        }

        return view('admin.pages.products.categories.available', [
            'product' => $product,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }

    public function attach(Request $request, $id)
    {
        $product = $this->product->query()->findOrFail($id);

        if (!$product)
            return redirect()->back();

        if (!isset($request->categories) || count($request->categories) <= 0)
            return redirect()->back()->with('error', 'Favor inserir pelo menos uma categoria.');

        $data = [];
        foreach ($request->categories as $category) {
            $data[] = ['category_id' => $category, 'id' => Str::uuid()];
        }

        $product->categories()->attach($data);


        return redirect()->route('products.categories.index', $id);
    }

    public function detach($productId, $categoryId)
    {
        $product = $this->product->find($productId);
        $category = $this->category->find($categoryId);

        if (!$product || !$category) {
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()
            ->route('products.categories.index', $product->id)
            ->with('message', 'Categoria removida com sucesso!');
    }
}
