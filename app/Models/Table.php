<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory, TenantTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    public $table = 'tables';
    protected $fillable = ['identity', 'description'];

    public function search($filter = null)
    {
        $records = $this->query()
            ->where('identity', 'like', "%$filter%")
            ->orWhere('description', 'like', "%$filter%")
            ->paginate(10);

        return $records;
    }
}
