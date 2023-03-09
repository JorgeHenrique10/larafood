<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\Api\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function store(OrderRequest $request)
    {
        $order = $this->orderService->storeOrder($request->all());
        return new OrderResource($order);
    }
    public function show()
    {
    }
}
