<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(private Order $order)
    {
    }

    public function storeOrder($identify, $total, $tenant_id, $status, $comment, $client_id = null, $table_id = null)
    {
    }
    public function getOrderByIdentify($identify)
    {
    }
}
