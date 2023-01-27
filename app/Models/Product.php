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

    public function search($filter = null)
    {
        $records = $this->query()
            ->where('title', 'like', "%$filter%")
            ->orWhere('description', 'like', "%$filter%")
            ->paginate(10);

        return $records;
    }

    public function categoriesAvailable($filter = null)
    {
        $categories = Category::query()->whereNotIn('id', function ($query) {
            $query->select('category_id');
            $query->from('category_product');
            $query->where('product_id', $this->id);
        })
            ->where('name', 'LIKE', "%{$filter}%")
            ->orderBy('created_at')
            ->paginate(10);

        return $categories;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
