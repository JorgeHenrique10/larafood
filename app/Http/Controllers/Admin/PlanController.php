<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->query()->latest()->paginate(10);

        return view('admin.pages.plans.index', ['plans' => $plans]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(PlanRequest $request)
    {
        $data = $request->all();
        $data['url'] = Str::kebab($data['name']);
        $this->repository->create($data);

        return redirect()->route('plans.index');
    }

    public function show($id)
    {
        $plan = $this->repository->query()->findOrFail($id);

        if (!$plan) {
            return redirect()->back();
        }
        return view('admin.pages.plans.show', ['plan' => $plan]);
    }

    public function destroy($id)
    {
        $plan = $this->repository
            ->query()
            ->with('details')
            ->findOrFail($id);

        if (!$plan) {
            return redirect()->back();
        }

        if ($plan->details()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Não é possível deletar o plano, pois existe detalhes vinculados.');
        }

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $request->except('_token')
        ]);
    }

    public function edit($id)
    {
        $plan = $this->repository->query()->findOrFail($id);

        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.edit', ['plan' => $plan]);
    }

    public function update(PlanRequest $request, $id)
    {
        $plan = $this->repository->query()->findOrFail($id);

        if (!$plan) {
            return redirect()->back();
        }

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }
}
