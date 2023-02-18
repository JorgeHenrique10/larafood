<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionProfileController extends Controller
{
    public function __construct(private Permission $permission, private Profile $profile)
    {
        $this->middleware(['can:profile']);
    }

    public function permissions($id)
    {
        $profile = $this->profile->query()->with('permissions')->findOrFail($id);

        if (!$profile)
            return redirect()->back();

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.index', [
            'profile' => $profile,
            'permissions' => $permissions
        ]);
    }

    public function profiles($id)
    {
        $permission = $this->permission->query()->with('profiles')->findOrFail($id);

        if (!$permission)
            return redirect()->back();

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.profiles.permissions.profiles.index', [
            'profiles' => $profiles,
            'permission' => $permission
        ]);
    }

    public function available(Request $request, $id)
    {
        $profile = $this->profile->query()->with('permissions')->findOrFail($id);

        if (!$profile)
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        if (!$filters) {
            $filters = [];
            $filters['filter'] = '';
        }

        return view('admin.pages.profiles.permissions.available', [
            'profile' => $profile,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    public function attach(Request $request, $id)
    {
        $profile = $this->profile->query()->findOrFail($id);

        if (!$profile)
            return redirect()->back();

        if (!isset($request->permissions) || count($request->permissions) <= 0)
            return redirect()->back()->with('error', 'Favor inserir pelo menos uma permissão.');

        $data = [];
        foreach ($request->permissions as $permission) {
            $data[] = ['permission_id' => $permission, 'id' => Str::uuid()];
        }

        $profile->permissions()->attach($data);


        return redirect()->route('profiles.permissions.index', $id);
    }

    public function detach($profileId, $permissionId)
    {
        $profile = $this->profile->find($profileId);
        $permission = $this->permission->find($permissionId);

        if (!$profile || !$permission) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()
            ->route('profiles.permissions.index', $profile->id)
            ->with('message', 'Permissão removida com sucesso!');
    }
}
