<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = auth()->user();
        $tenant = $users->tenant;

        $userTotal = $tenant->users->count();
        $tablesTotal = $tenant->tables->count();
        $categoriesTotal = $tenant->categories->count();
        $productsTotal = $tenant->products->count();
        $planTotal = $tenant->plan->count();
        $rolesTotal = $tenant->roles->count();
        $permissionsTotal = Permission::all()->count();




        // dd($tenant);

        return view('admin.pages.dashboard.dashboard', compact(
            [
                'userTotal',
                'tablesTotal',
                'categoriesTotal',
                'productsTotal',
                'planTotal',
                'rolesTotal',
                'permissionsTotal'
            ]
        ));
    }
}
