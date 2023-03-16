<?php

namespace App\Repositories;

use App\Models\EvaluationOrder;
use App\Repositories\Contracts\EvaluationOrderRepositoryInterface;

class EvaluationOrderRepository implements EvaluationOrderRepositoryInterface
{
    public function __construct(private EvaluationOrder $evaluationOrder)
    {
    }

    public function storeEvaluationOrder(array $data)
    {
        return $this->evaluationOrder->create($data);
    }

    public function getEvaluationsOrderByOrderId(string $orderId)
    {
        return $this->evaluationOrder->query()->where('order_id', $orderId)->paginate();
    }

    public function getEvaluationsOrderByOrderIdAndClientId(string $orderId, string $clientId)
    {
        return $this->evaluationOrder->query()
            ->where('order_id', $orderId)
            ->where('client_id', $clientId)
            ->paginate();
    }

    public function getEvaluationsOrderByClientId(string $clientId)
    {
        return $this->evaluationOrder->query()->where('client_id', $clientId)->paginate();
    }

    public function getEvaluationOrderById(string $orderEvaluationId)
    {
        return $this->evaluationOrder->query()->where('id', $orderEvaluationId)->first();
    }
}
