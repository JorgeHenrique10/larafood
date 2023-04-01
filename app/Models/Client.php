<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, UuidTrait, HasApiTokens;

    public $incrementing = false;
    protected $keyType = "uuid";
    protected $table = 'clients';
    protected $fillable = ['name', 'email', 'email_verified_at', 'password'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function evaluations()
    {
        return $this->hasMany(EvaluationOrder::class);
    }
}
