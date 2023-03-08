<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = "uuid";
    protected $table = 'clients';
    protected $fillable = ['name', 'email', 'email_verified_at', 'password'];
}
