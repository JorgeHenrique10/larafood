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

    public function search($filter)
    {
        $records =  $this->query()
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")->paginate(10);

        return $records;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
