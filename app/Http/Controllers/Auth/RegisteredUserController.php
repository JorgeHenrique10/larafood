<?php

namespace App\Http\Controllers\Auth;

use App\Events\TenantCreated;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\TenantService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cnpj' => ['required', 'unique:tenants', 'string', 'digits:14'],
            'tenant' => ['required', 'unique:tenants,name', 'string']
        ]);

        if (!$plan = session('plan'))
            return redirect()->route('site.home');

        $tenantService = new TenantService($plan, $request->all());

        $tenant = $tenantService->tenantStore();

        $user = $tenantService->userStore($tenant);

        event(new Registered($user));
        Auth::loginUsingId($user->id);

        event(new TenantCreated($user));

        return redirect()->route('admin.index');
    }
}
