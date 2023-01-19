<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, TenantTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    public $table = 'products';
    protected $fillable = ['title', 'flag', 'description', 'price', 'image'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
