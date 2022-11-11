<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanProfileController extends Controller
{
    public function __construct(private Plan $plan, private Profile $profile)
    {
    }

    public function index(Request $request, $id)
    {
        $profile = $this->profile->query()->with('plans')->findOrFail($id);

        if (!$profile)
            return redirect()->back();

        $plans = $profile->plans()->latest()->paginate(10);

        return view('admin.pages.profiles.plans.index', [
            'plans' => $plans,
            'profile' => $profile
        ]);
    }

    public function available(Request $request, $id)
    {
        $profile = $this->profile->findOrFail($id);

        $filters = $request->except('_token');

        if (!$profile)
            return redirect()->back();

        $plans = $profile->plansAvailable($request->filter);

        if (!$request->filter) {
            $filters['filter'] =  '';
        }

        return view('admin.pages.profiles.plans.available', [
            'plans' => $plans,
            'profile' => $profile,
            'filters' => $filters
        ]);
    }

    public function ProfileAvailables(Request $request, $id)
    {
        $plan = $this->plan->findOrFail($id);

        $filters = $request->except('_token');

        if (!$plan)
            return redirect()->back();

        $profiles = $plan->profileAvailable($request->filter);

        if (!$request->filter) {
            $filters['filter'] =  '';
        }

        return view('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles,
            'filters' => $filters
        ]);
    }

    public function attach(Request $request, $id)
    {
        $profile = $this->profile->findOrFail($id);

        if (!$profile)
            return redirect()->back();


        if (!$plansCheck = $request->plans)
            return redirect()->back()->with('error', 'Favor selecionar ao menos um plano');

        $data = array_map(function ($item) {
            $date = now();
            $temp = ['id' => Str::uuid(), 'plan_id' => $item, 'created_at' => $date, 'updated_at' => $date];
            return $temp;
        }, $plansCheck);

        $profile->plans()->attach($data);

        return redirect()->route('profiles.plans.index', $id)->with('message', 'Plano(s) associados com sucesso.');
    }

    public function profileAttach(Request $request, $id)
    {
        $plan = $this->plan->findOrFail($id);

        if (!$plan)
            return redirect()->back();


        if (!$profilesCheck = $request->profiles)
            return redirect()->back()->with('error', 'Favor selecionar ao menos um plano');

        $data = array_map(function ($item) {
            $date = now();
            $temp = ['id' => Str::uuid(), 'profile_id' => $item, 'created_at' => $date, 'updated_at' => $date];
            return $temp;
        }, $profilesCheck);

        $plan->profiles()->attach($data);

        return redirect()->route('plans.profiles.index', $id)->with('message', 'Perfis associados com sucesso.');
    }

    public function detach($idProfile, $idPlan)
    {
        $profile = $this->profile->findOrFail($idProfile);

        if (!$profile)
            return redirect()->back();

        $profile->plans()->detach($idPlan);

        return redirect()->route('profiles.plans.index', $idProfile)->with('message', 'Plano desassociado com sucesso.');
    }

    public function profileDetach($idPlan, $idProfile)
    {
        $plan = $this->plan->findOrFail($idPlan);

        if (!$plan)
            return redirect()->back();

        $plan->profiles()->detach($idProfile);

        return redirect()->route('plans.profiles.index', $idPlan)->with('message', 'Perfil desassociado com sucesso.');
    }

    public function profiles($id)
    {
        $plan = $this->plan->query()->with('profiles')->findOrFail($id);

        if (!$plan)
            return redirect()->back();

        $profiles = $plan->profiles()->paginate(10);

        return view('admin.pages.plans.profiles.index', [
            'plan' => $plan,
            'profiles' => $profiles
        ]);
    }
}
