<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'role_user';
    protected $fillable = ['user_id', 'role_id'];
}
