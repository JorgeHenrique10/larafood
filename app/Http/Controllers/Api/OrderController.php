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
    public function show($identify)
    {
        $order = $this->orderService->getOrderByIdentity($identify);

        if (!$order)
            return response()->json(['message' => 'Order not found!'], 404);

        return new OrderResource($order);
    }
    public function myOrders()
    {
        $orders = $this->orderService->getMyOrders();

        if (!$orders)
            return response()->json(['message' => 'You have no order!'], 404);

        return OrderResource::collection($orders);
    }
}
