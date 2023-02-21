<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $repository;

    public function __construct(Role $role)
    {
        $this->repository = $role;
        $this->middleware(['can:role']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->orderBy('name')->paginate(10);

        return view('admin.pages.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()
            ->route('roles.index')
            ->with('message', 'Perfil criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->repository->query()->findOrFail($id);

        if (!$role)
            return redirect()->back();

        return view('admin.pages.roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->repository->query()->findOrFail($id);
        if (!$role)
            return redirect()->back();

        return view('admin.pages.roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = $this->repository->query()->findOrFail($id);

        if (!$role)
            return redirect()->back();

        $role->update($request->all());

        return redirect()
            ->route('roles.index')
            ->with('message', 'Perfil atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->repository->query()->findOrFail($id);

        if (!$role)
            return redirect()->back();

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('message', 'Perfil deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $roles = $this->repository->search($request->get('filter'));
        $filters = $request->get('filter') ? $request->except('_token') : ['filter' => null];
        return view('admin.pages.roles.index', [
            'roles' => $roles,
            'filters' => $filters
        ]);
    }
}
