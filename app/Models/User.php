<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Trait\UserACLTrait;
use App\Models\Trait\UuidTrait;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidTrait, UserACLTrait;

    public $incrementing = false;
    public $keyType = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function search($filter)
    {
        $records =  $this->query()
            ->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', "%{$filter}%");
                $query->orWhere('email', '=', $filter);
            })->tenantUser()->paginate(10);

        return $records;
    }

    public function usersAvailable($filter)
    {
        $roles = $this->query()->whereNotIn('id', function ($query) {
            $query->select('role_id');
            $query->from('role_user');
            $query->where('role_id', $this->id);
        })
            ->where('name', 'LIKE', "%{$filter}%")
            ->orderBy('created_at')->paginate(10);

        return $roles;
    }

    public function scopeTenantUser(Builder $query)
    {
        return $query->where('tenant_id', Auth::user()->tenant_id);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
}
