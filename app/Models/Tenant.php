<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'tenants';
    protected $fillable = [
        'plan_id', 'cnpj', 'name', 'url', 'email', 'logo', 'active', 'subscription',
        'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
