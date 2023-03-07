<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantServiceApi;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function __construct(private TenantServiceApi $tenantService)
    {
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 10);
        return  TenantResource::collection($this->tenantService->getAllTenants($per_page));
    }

    public function show($uuid)
    {
        $tenant = $this->tenantService->getTenantByUuid($uuid);

        if (!$tenant) {
            return response()->json(['message' => 'Tenant não encontrado'], 404);
        }
        return  new TenantResource($this->tenantService->getTenantByUuid($uuid));
    }
}
