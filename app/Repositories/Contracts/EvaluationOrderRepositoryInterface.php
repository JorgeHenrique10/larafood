<?php

namespace App\Repositories\Contracts;

interface EvaluationOrderRepositoryInterface
{
    public function storeEvaluationOrder(array $data);
    public function getEvaluationsOrderByOrderId(string $orderId);
    public function getEvaluationsOrderByOrderIdAndClientId(string $orderId, string $clientId);
    public function getEvaluationsOrderByClientId(string $clientId);
    public function getEvaluationOrderById(string $orderEvaluationId);
}
