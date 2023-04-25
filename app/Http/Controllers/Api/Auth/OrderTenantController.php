<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderTenantController extends Controller
{
    public function index()
    {

        if (!auth()->check())
            return abort('403', 'Não autenticado');

        return OrderResource::collection(Order::get());
    }
}
