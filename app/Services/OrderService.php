<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{

    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private TableRepositoryInterface $tableRepository,
        private ProductRepositoryInterface $productRepositoryInterface
    ) {
    }

    public function getMyOrders()
    {
        $clientId = Auth::user()->id;
        $orders = $this->orderRepository->getOrdersClientById($clientId);
        return $orders;
    }

    public function getOrderByIdentity($identity)
    {
        $order = $this->orderRepository->getOrderByIdentify($identity);

        return $order;
    }

    public function storeOrder(array $data)
    {
        try {
            DB::beginTransaction();
            $products = $this->getProductsOrder($data['products'] ?? []);
            $identify = $this->getIdentifyOrder();
            $total = $this->getTotalOrder($products);
            $tenant_id = $data['tenant_id'];
            $status = 'open';
            $comment = isset($data['comment']) ? $data['comment'] : null;
            $client_id = $this->getClientId();
            $table_id = $this->getTableId($data['table_id'] ?? null);

            $order = $this->orderRepository->storeOrder(
                $identify,
                $total,
                $tenant_id,
                $status,
                $comment,
                $client_id,
                $table_id
            );

            $this->orderRepository->storeProductsOrder($order->id, $products);
            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    private function getIdentifyOrder($qtd = 8): string
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvxwyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $characters = $smallLetters . $numbers;

        $identify = substr((str_shuffle($characters)), 0, $qtd);

        if ($this->getOrderByIdentity($identify)) {
            $this->getIdentifyOrder($qtd + 1);
        }

        return $identify;
    }

    private function getProductsOrder($productsOrder): array
    {
        $products = [];
        foreach ($productsOrder as $product) {
            $productNew = $this->productRepositoryInterface->getProductByUuid($product['id']);
            array_push($products, [
                'id' => $productNew->id,
                'qtd' => $product['qtd'],
                'price' => $productNew->price
            ]);
        }

        return $products;
    }

    private function getTotalOrder(array $products): float
    {
        $total = 0;

        foreach ($products as $product) {
            $total += ($product['price'] * $product['qtd']);
        }

        return (float) $total;
    }

    private function getClientId()
    {
        return auth()->check() ? auth()->user()->id : null;
    }

    private function getTableId($table_id = null)
    {
        if ($table_id) {
            $table =  $this->tableRepository->getTableByUuid($table_id);
            return $table->id;
        }

        return $table_id;
    }
}
