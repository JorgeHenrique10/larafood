<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;

class OrderService
{

    public function __construct(private OrderRepositoryInterface $orderRepository, private TableRepositoryInterface $tableRepository)
    {
    }

    public function getOrderByIdentity($identity)
    {
    }

    public function storeOrder(array $data)
    {

        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder([]);
        $tenant_id = $data['tenant_id'];
        $status = 'open';
        $comment = isset($data['comment']) ? $data['comment'] : '';
        $client_id = $this->getClientId();
        $table_id = $this->getTableId($data['table_id']);

        $order = $this->orderRepository->storeOrder(
            $identify,
            $total,
            $tenant_id,
            $status,
            $comment,
            $client_id,
            $table_id
        );

        return $order;
    }

    private function getIdentifyOrder()
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvxwyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    }

    private function getTotalOrder(array $products): float
    {
        return (float) 10;
    }

    private function getClientId()
    {
        return auth()->check() ? auth()->user()->id : '';
    }
    private function getTableId($table_id = null)
    {
        if ($table_id)
            return $this->tableRepository->getTableByUuid($table_id);

        return $table_id;
    }
}
