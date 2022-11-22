<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'plans';
    protected $fillable = ['name', 'description', 'url', 'price'];

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'plan_id');
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'plan_profile');
    }

    public function details()
    {
        return $this->hasMany(DetailPlan::class, 'plan_id')->orderBy('name');
    }

    public function search($filter = null)
    {
        $plans = $this
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate(10);

        return $plans;
    }

    public function profileAvailable($filter = null)
    {
        $profiles = Profile::query()->whereNotIn('id', function ($query) {
            $query->select('profile_id');
            $query->from('plan_profile');
            $query->where('plan_id', $this->id);
        })
            ->where('name', 'LIKE', "%{$filter}%")
            ->orderBy('created_at')
            ->paginate(10);

        return $profiles;
    }
}
