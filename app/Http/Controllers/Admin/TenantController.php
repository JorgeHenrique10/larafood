<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;
        $this->middleware(['can:tenant']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->query()->paginate(10);

        return view('admin.pages.tenants.index', ['tenants' => $tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenantRequest $request)
    {
        $tenant = Auth::user()->tenant;
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            $data['image'] = Storage::disk('public')->put("tenants/$tenant->id", $request->image);
        }
        $tenant = $this->repository->create($data);
        return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenant = $this->repository->query()->findOrFail($id);

        if (!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.show', ['tenant' => $tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenant = $this->repository->query()->findOrFail($id);

        if (!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.edit', ['tenant' => $tenant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TenantRequest $request, $id)
    {
        $tenant = Auth::user()->tenant;
        $data = $request->all();

        $tenant = $this->repository->query()->findOrFail($id);

        if ($request->hasFile('logo') && $request->logo->isValid()) {
            Storage::disk('public')->delete($tenant->logo);
            $data['logo'] = Storage::disk('public')->put("tenants/$tenant->id", $request->logo);
        }

        if (!$tenant)
            return redirect()->back();

        $tenant->update($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tenant = $this->repository->query()->findOrFail($id);

        if (!$tenant)
            return redirect()->back();

        Storage::disk('public')->delete($tenant->image);
        $tenant->delete();

        return redirect()
            ->route('tenants.index')
            ->with('message', 'Categoria deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $tenants = $this->repository->search($request->get('filter'));
        $filters = $request->get('filter') ? $request->except('_token') : ['filter' => null];
        return view('admin.pages.tenants.index', [
            'tenants' => $tenants,
            'filters' => $filters
        ]);
    }
}
