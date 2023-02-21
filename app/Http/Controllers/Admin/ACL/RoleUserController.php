<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleUserController extends Controller
{
    public function __construct(private User $user, private Role $role)
    {
        $this->middleware(['can:role']);
    }

    public function users($id)
    {
        $user = $this->user->query()->with('roles')->findOrFail($id);

        if (!$user)
            return redirect()->back();

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.index', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function roles($id)
    {
        $user = $this->user->query()->with('roles')->findOrFail($id);

        if (!$user)
            return redirect()->back();

        $roles = $user->roles()->paginate();

        return view('admin.pages.roles.users.roles.index', [
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function available(Request $request, $id)
    {
        $user = $this->user->query()->with('roles')->findOrFail($id);

        if (!$user)
            return redirect()->back();

        $filters = $request->except('_token');

        $roles = $this->role->rolesUserAvailable($id, $request->filter);

        if (!$filters) {
            $filters = [];
            $filters['filter'] = '';
        }

        return view('admin.pages.users.roles.available', [
            'user' => $user,
            'roles' => $roles,
            'filters' => $filters
        ]);
    }

    public function attach(Request $request, $id)
    {
        $user = $this->user->query()->findOrFail($id);

        if (!$user)
            return redirect()->back();

        if (!isset($request->roles) || count($request->roles) <= 0)
            return redirect()->back()->with('error', 'Favor inserir pelo menos um cargo.');

        $data = [];
        foreach ($request->roles as $role) {
            $data[] = [
                'role_id' => $role,
                'id' => Str::uuid()
            ];
        }

        $user->roles()->attach($data);


        return redirect()->route('roles.users.index', $id);
    }

    public function detach($roleId, $userId)
    {
        $role = $this->role->find($roleId);
        $user = $this->user->find($userId);

        if (!$role || !$user) {
            return redirect()->back();
        }

        $role->users()->detach($user);

        return redirect()
            ->route('roles.users.index', $user->id)
            ->with('message', 'Permissão removida com sucesso!');
    }
}
