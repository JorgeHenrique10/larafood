<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'profiles';
    protected $fillable = ['name', 'description'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_profile');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_profile');
    }

    public function search($filter)
    {
        $records =  $this->query()
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")->paginate(10);

        return $records;
    }

    public function permissionsAvailable($filter)
    {
        $permissions = Permission::query()->whereNotIn('id', function ($query) {
            $query->select('permission_id');
            $query->from('permission_profile');
            $query->where('profile_id', $this->id);
        })
            ->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', "%{$filter}%");
            })
            ->orderBy('created_at')->paginate(10);

        return $permissions;
    }

    public function plansAvailable($filter)
    {
        $plans = Plan::query()->whereNotIn('id', function ($query) {
            $query->select('plan_id');
            $query->from('plan_profile');
            $query->where('profile_id', $this->id);
        })
            ->where('name', 'LIKE', "%{$filter}%")
            ->orderBy('created_at')->paginate(10);

        return $plans;
    }
}
