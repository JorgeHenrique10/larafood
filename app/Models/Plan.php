<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'plans';
    protected $fillable = ['name', 'description', 'url', 'price'];


    public function details()
    {
        return $this->hasMany(DetailPlan::class, 'plan_id');
    }

    public function search($filter = null)
    {
        $plans = $this
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate(10);

        return $plans;
    }
}
