<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyTipe = 'uuid';
    protected $table = 'detail_plans';
    protected $fillable = ['name', 'plan_id'];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
