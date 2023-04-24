<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Table;
use App\Models\Tenant;
use App\Observers\CategoryObserver;
use App\Observers\OrderObserver;
use App\Observers\PlanObserver;
use App\Observers\ProductObserver;
use App\Observers\RoleObserver;
use App\Observers\RolePermissionObserver;
use App\Observers\TableObserver;
use App\Tenant\Observers\TenantObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Tenant::observe(TenantObserver::class);
        Plan::observe(PlanObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Table::observe(TableObserver::class);
        Role::observe(RoleObserver::class);
        Order::observe(OrderObserver::class);
        RolePermission::observe(RolePermissionObserver::class);
        Paginator::useBootstrap();

        /**
         * IF Stattements
         */

        Blade::if('admin', function () {
            $user = auth()->user();
            return $user->isAdmin();
        });
    }
}
