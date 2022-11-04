<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailPlanRequest;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    private $repository;
    private $repositoryPlan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->repositoryPlan = $plan;
    }

    public function index($id)
    {
        $plan = $this->repositoryPlan->query()->findOrFail($id);

        if (!$plan) {
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }

    public function create($id)
    {
        $plan = $this->repositoryPlan->query()->findOrFail($id);

        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', ['plan' => $plan]);
    }

    public function store(DetailPlanRequest $request, $planId)
    {
        $plan = $this->repositoryPlan->query()->findOrFail($planId);

        if (!$plan) {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('detail.plans.index', $planId);
    }
}
