<?php

namespace App\Tenant\Traits;

use App\Tenant\Observers\TenantObserver;

trait TenantTrait
{
    protected static function boot()
    {
        parent::boot();
        static::observe(TenantObserver::class);

        // static::creating(function ($category) {
        //     $category->url = Str::kebab($category->name);
        //     $category->{$category->getKeyName()} = (string) Str::uuid();
        // });

        // static::updating(function ($category) {
        //     $category->url = Str::kebab($category->name);
        // });

    }
}
