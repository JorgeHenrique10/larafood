<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'role_permission';
    protected $fillable = ['permission_id', 'role_id'];
}
