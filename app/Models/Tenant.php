<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    // use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'tenants';
    protected $fillable = [
        'plan_id', 'cnpj', 'name', 'url', 'email', 'logo', 'active', 'subscription',
        'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended'
    ];

    public function search($filter)
    {
        return $this->query()->where('name', 'like', "%$filter%")->paginate(10);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
