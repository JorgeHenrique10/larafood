<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationOrderRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EvaluationOrderService
{
    public function __construct(
        private EvaluationOrderRepositoryInterface $evaluationOrderRepository,
        private OrderRepositoryInterface $orderRepository
    ) {
    }

    public function getEvaluationOrderById(string $id)
    {
        return $this->evaluationOrderRepository->getEvaluationOrderById($id);
    }

    public function getEvaluationsByOrderIdentify($identifyOrder)
    {
        $orderId = $this->getOrderByIdentify($identifyOrder);

        return $this->evaluationOrderRepository->getEvaluationsOrderByOrderId($orderId);
    }

    public function storeEvaluationOrder(string $identifyOrder, int $stars, string $comment = null)
    {
        $clientId = $this->getClientIdAuth();
        $orderId = $this->getOrderByIdentify($identifyOrder);
        $data = [
            'client_id' => $clientId,
            'order_id' => $orderId,
            'stars' => $stars,
            'comment' => $comment
        ];

        return $this->evaluationOrderRepository->storeEvaluationOrder($data);
    }

    protected function getOrderByIdentify($identify)
    {
        $order = $this->orderRepository->getOrderByIdentify($identify);

        return $order->id;
    }

    protected function getClientIdAuth()
    {
        $user = Auth::user();

        return $user->id;
    }
}
