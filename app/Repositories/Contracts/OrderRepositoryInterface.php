<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function storeOrder($identify, $total, $tenant_id, $status, $comment, $client_id = null, $table_id = null);
    public function getOrderByIdentify($identify);
    public function storeProductsOrder($orderId, $products);
    public function getOrdersClientById($clientId);
}
