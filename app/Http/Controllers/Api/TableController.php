<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\Api\TableResource;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct(private TableService $tableService)
    {
    }

    public function index(TenantFormRequest $request)
    {
        $tables = $this->tableService->getTablesByTenantUuid($request->get('tenant_id'));

        return TableResource::collection($tables);
    }

    public function show(TenantFormRequest $request, $uuid)
    {
        $table = $this->tableService->getTableByUuid($uuid);

        if (!$table) {
            return response()->json(['message' => 'Table Not Found!'], 404);
        }
        return new TableResource($table);
    }
}
