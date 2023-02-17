<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
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
        Paginator::useBootstrap();
    }
}
