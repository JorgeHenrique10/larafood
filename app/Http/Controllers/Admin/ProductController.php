<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->query()->paginate(10);

        return view('admin.pages.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $tenant = Auth::user()->tenant;
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            $data['image'] = Storage::disk('public')->put("products/$tenant->id", $request->image);
        }
        $product = $this->repository->create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->repository->query()->findOrFail($id);

        if (!$product)
            return redirect()->back();

        return view('admin.pages.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->repository->query()->findOrFail($id);

        if (!$product)
            return redirect()->back();

        return view('admin.pages.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $tenant = Auth::user()->tenant;
        $data = $request->all();

        $product = $this->repository->query()->findOrFail($id);

        if ($request->hasFile('image') && $request->image->isValid()) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = Storage::disk('public')->put("products/$tenant->id", $request->image);
        }

        if (!$product)
            return redirect()->back();

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->query()->findOrFail($id);

        if (!$product)
            return redirect()->back();

        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('message', 'Categoria deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $products = $this->repository->search($request->get('filter'));
        $filters = $request->get('filter') ? $request->except('_token') : ['filter' => null];
        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters
        ]);
    }
}
