<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, TenantTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'url', 'tenant_id'];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($category) {
    //         $category->url = Str::kebab($category->name);
    //     });

    //     static::updating(function ($category) {
    //         $category->url = Str::kebab($category->name);
    //     });
    // }
}
