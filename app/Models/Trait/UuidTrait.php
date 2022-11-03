<?php

namespace App\Models\Trait;

use Illuminate\Support\Str;

trait UuidTrait
{
    public static function booted()
    {
        static::creating(fn ($model) => $model->{$model->getKeyName()} = (string) Str::uuid());
    }
}
