<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RolePermissionController extends Controller
{
    public function __construct(private Permission $permission, private Role $role)
    {
        $this->middleware(['can:role']);
    }

    public function permissions($id)
    {
        $role = $this->role->query()->with('permissions')->findOrFail($id);

        if (!$role)
            return redirect()->back();

        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.index', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function roles($id)
    {
        $permission = $this->permission->query()->with('roles')->findOrFail($id);

        if (!$permission)
            return redirect()->back();

        $roles = $permission->roles()->paginate();

        return view('admin.pages.roles.permissions.roles.index', [
            'roles' => $roles,
            'permission' => $permission
        ]);
    }

    public function available(Request $request, $id)
    {
        $role = $this->role->query()->with('permissions')->findOrFail($id);

        if (!$role)
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        if (!$filters) {
            $filters = [];
            $filters['filter'] = '';
        }

        return view('admin.pages.roles.permissions.available', [
            'role' => $role,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    public function attach(Request $request, $id)
    {
        $role = $this->role->query()->findOrFail($id);

        if (!$role)
            return redirect()->back();

        if (!isset($request->permissions) || count($request->permissions) <= 0)
            return redirect()->back()->with('error', 'Favor inserir pelo menos uma permissão.');

        $data = [];
        foreach ($request->permissions as $permission) {
            $data[] = [
                'permission_id' => $permission,
                'id' => Str::uuid()
            ];
        }

        $role->permissions()->attach($data);


        return redirect()->route('roles.permissions.index', $id);
    }

    public function detach($roleId, $permissionId)
    {
        $role = $this->role->find($roleId);
        $permission = $this->permission->find($permissionId);

        if (!$role || !$permission) {
            return redirect()->back();
        }

        $role->permissions()->detach($permission);

        return redirect()
            ->route('roles.permissions.index', $role->id)
            ->with('message', 'Permissão removida com sucesso!');
    }
}
