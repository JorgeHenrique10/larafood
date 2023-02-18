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
        $this->middleware(['can:plan']);
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

    public function edit($idPlan, $idDetail)
    {
        $plan = $this->repositoryPlan->query()->findOrFail($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        $detail = $plan->details()->find($idDetail);

        return view('admin.pages.plans.details.edit', ['plan' => $plan, 'detail' => $detail]);
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

    public function update(DetailPlanRequest $request, $idPlan, $idDetail)
    {
        $plan = $this->repositoryPlan->query()->findOrFail($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        $plan->details()->where('id', $idDetail)->update($request->except(['_token', '_method']));

        return redirect()->route('detail.plans.index', $idPlan);
    }

    public function show($idPlan, $idDetail)
    {
        $plan = $this->repositoryPlan->query()->findOrFail($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        $detail = $plan->details()->find($idDetail);

        return view('admin.pages.plans.details.show', ['plan' => $plan, 'detail' => $detail]);
    }

    public function destroy($idPlan, $idDetail)
    {
        $plan = $this->repositoryPlan->query()->findOrFail($idPlan);

        if (!$plan) {
            return redirect()->back();
        }

        $plan->details()->where('id', $idDetail)->delete();

        return redirect()->route('detail.plans.index', $idPlan)
            ->with('message', 'Detalhe removido com sucesso!');
    }
}
