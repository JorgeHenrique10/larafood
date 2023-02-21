<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'permissions';
    protected $fillable = ['name', 'description'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'permission_profile');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }
}
