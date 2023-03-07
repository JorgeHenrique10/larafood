<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $table;
    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid($uuid)
    {

        $categories =  DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('tenants.id', $uuid)
            ->select('categories.*')
            ->get();

        return $categories;
    }

    public function getCategoryByUuid($uuid)
    {
        $category = DB::table($this->table)
            ->where('id', $uuid)
            ->first();

        return $category;
    }
}
