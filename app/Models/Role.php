<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, TenantTrait;

    public $incrementing = false;
    protected $keyTipe = 'uuid';
    protected $table = 'roles';
    protected $fillable = ['name', 'description', 'tenant_id'];

    public function search($filter)
    {
        return $this->query()
            ->where('name', 'like', "%$filter%")
            ->orWhere('description', 'like', "$filter")
            ->orderBy('name')
            ->paginate(10);
    }

    public function permissionsAvailable($filter)
    {
        $permissions = Permission::query()->whereNotIn('id', function ($query) {
            $query->select('permission_id');
            $query->from('role_permission');
            $query->where('role_id', $this->id);
        })
            ->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', "%{$filter}%");
            })
            ->orderBy('created_at')->paginate(10);

        return $permissions;
    }

    public function rolesAvailable($filter)
    {
        $roles = Role::query()->whereNotIn('id', function ($query) {
            $query->select('role_id');
            $query->from('role_permission');
            $query->where('role_id', $this->id);
        })
            ->where('name', 'LIKE', "%{$filter}%")
            ->orderBy('created_at')->paginate(10);

        return $roles;
    }

    public function rolesUserAvailable($id, $filter)
    {
        $roles = $this->query()->whereNotIn('id', function ($query) use ($id) {
            $query->select('role_id');
            $query->from('role_user');
            $query->where('user_id', $id);
        })
            ->where('name', 'LIKE', "%{$filter}%")
            ->orderBy('created_at')->paginate(10);

        return $roles;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
