<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->paginate(10);

        return view('admin.pages.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->repository->query()->findOrFail($id);

        if (!$permission)
            return redirect()->back();

        return view('admin.pages.permissions.show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->repository->query()->findOrFail($id);
        if (!$permission)
            return redirect()->back();

        return view('admin.pages.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = $this->repository->query()->findOrFail($id);

        if (!$permission)
            return redirect()->back();

        $permission->update($request->all());

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->repository->query()->findOrFail($id);

        if (!$permission)
            return redirect()->back();

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $permissions = $this->repository->search($request->get('filter'));
        $filters = $request->get('filter') ? $request->except('_token') : ['filter' => null];
        return view('admin.pages.permissions.index', [
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }
}
