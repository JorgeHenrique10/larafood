<?php

namespace App\Tenant\Traits;

use App\Tenant\Observers\TenantObserver;
use App\Tenant\Scopes\TenantScope;

trait TenantTrait
{
    protected static function boot()
    {
        parent::boot();
        static::observe(TenantObserver::class);
        static::addGlobalScope(new TenantScope);
        // static::creating(function ($category) {
        //     $category->url = Str::kebab($category->name);
        //     $category->{$category->getKeyName()} = (string) Str::uuid();
        // });

        // static::updating(function ($category) {
        //     $category->url = Str::kebab($category->name);
        // });

    }
}
