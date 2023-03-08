<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientRequest;
use App\Http\Resources\Api\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(private ClientService $clientService)
    {
    }

    public function store(ClientRequest $request)
    {
        $client = $this->clientService->storeClient($request->all());

        return new ClientResource($client);
    }
}
