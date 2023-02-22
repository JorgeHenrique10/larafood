<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Table;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\RoleObserver;
use App\Observers\RolePermissionObserver;
use App\Observers\TableObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Table::observe(TableObserver::class);
        Role::observe(RoleObserver::class);
        RolePermission::observe(RolePermissionObserver::class);
        Paginator::useBootstrap();
    }
}
