<?php

namespace App\Repositories;

use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    private $table;
    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTablesByTenantUuid($uuid)
    {

        $tables =  DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->where('tenants.id', $uuid)
            ->select('tables.*')
            ->get();

        return $tables;
    }

    public function getTableByUuid($uuid)
    {
        $table = DB::table($this->table)
            ->where('id', $uuid)
            ->first();

        return $table;
    }
}
