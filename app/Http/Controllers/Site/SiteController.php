<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct(private Plan $plan)
    {
    }
    public function index()
    {
        $plans = $this->plan
            ->with('details')
            ->orderBy('price', 'asc')
            ->get();
        return view('site.pages.home.index', ['plans' => $plans]);
    }
}
