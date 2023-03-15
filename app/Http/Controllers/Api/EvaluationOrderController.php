<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EvaluationOrderRequest;
use App\Http\Resources\Api\EvaluationOrderResource;
use App\Services\EvaluationOrderService;
use Illuminate\Http\Request;

class EvaluationOrderController extends Controller
{
    public function __construct(private EvaluationOrderService $evaluationOrderService)
    {
    }

    public function store(EvaluationOrderRequest $request)
    {
        $evaluation = $this->evaluationOrderService->storeEvaluationOrder(
            $request->get('identityOrder'),
            $request->get('stars'),
            $request->get('comment')
        );
        return new EvaluationOrderResource($evaluation);
    }
}
