<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Str;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(private Order $order)
    {
    }

    public function getOrdersClientById($clientId)
    {
        return $this->order->where('client_id', $clientId)->paginate(10);
    }

    public function storeOrder($identify, $total, $tenant_id, $status, $comment, $client_id = null, $table_id = null)
    {

        $order = $this->order->create([
            'identify' => $identify,
            'total' => $total,
            'tenant_id' => $tenant_id,
            'status' => $status,
            'comment' => $comment,
            'client_id' => $client_id,
            'table_id' => $table_id,
        ]);

        return $order;
    }

    public function getOrderByIdentify($identify)
    {
        $order = $this->order->where('identify', $identify)->first();
        return $order;
    }

    public function storeProductsOrder($orderId, $products)
    {
        $productsOrder = [];
        foreach ($products as $product) {
            $productsOrder[$product['id']] = [
                'price' => $product['price'],
                'qtd' => $product['qtd'],
                'id' => Str::uuid()
            ];
        }
        $order = $this->order->find($orderId);

        return $order->products()->attach($productsOrder);
    }
}
