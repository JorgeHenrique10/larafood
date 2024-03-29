<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\ACL\RoleController;
use App\Http\Controllers\Admin\ACL\RolePermissionController;
use App\Http\Controllers\Admin\ACL\RoleUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/**
 * Sites
 */
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/plan/{id}', [SiteController::class, 'plan'])->name('plan.subscription');

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('test-acl', function () {
            $teste =  Auth::user()->isAdmin();

            dd($teste);
        });

        /**
         * Routes Role x User
         */
        Route::post('roles/{roleId}/users/{userId}/detach', [RoleUserController::class, 'detach'])->name('roles.users.detach');
        Route::post('roles/{id}/users', [RoleUserController::class, 'attach'])->name('roles.users.attach');
        Route::any('roles/{id}/users/available', [RoleUserController::class, 'available'])->name('roles.users.available');
        Route::get('roles/{id}/users', [RoleUserController::class, 'users'])->name('roles.users.index');
        Route::get('users/{id}/roles', [RoleUserController::class, 'roles'])->name('roles.users.roles.index');

        /**
         * Routes Role x Permission
         */
        Route::post('roles/{roleId}/permissions/{permissionId}/detach', [RolePermissionController::class, 'detach'])->name('roles.permissions.detach');
        Route::post('roles/{id}/permissions', [RolePermissionController::class, 'attach'])->name('roles.permissions.attach');
        Route::any('roles/{id}/permissions/available', [RolePermissionController::class, 'available'])->name('roles.permissions.available');
        Route::get('roles/{id}/permissions', [RolePermissionController::class, 'permissions'])->name('roles.permissions.index');
        Route::get('permissions/{id}/roles', [RolePermissionController::class, 'roles'])->name('roles.permissions.roles.index');

        /**
         * Routes Role
         */
        Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');
        Route::resource('roles', RoleController::class);

        /**
         * Routes Product
         */
        Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
        Route::resource('tenants', TenantController::class);

        /**
         * Routes Table
         */
        Route::any('tables/qrcode/{identity}', [TableController::class, 'showQrcode'])->name('tables.showQrcode');
        Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
        Route::resource('tables', TableController::class);

        /**
         * Routes Category x Product
         */
        Route::delete('products/{profileId}/categories/{permissionId}/detach', [CategoryProductController::class, 'detach'])->name('products.categories.detach');
        Route::post('products/{id}/categories', [CategoryProductController::class, 'attach'])->name('products.categories.attach');
        Route::any('products/{id}/categories/available', [CategoryProductController::class, 'available'])->name('products.categories.available');
        Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories.index');
        Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('products.categories.products.index');

        /**
         * Routes Product
         */
        Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
        Route::resource('products', ProductController::class);

        /**
         * Routes Category
         */
        Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::resource('categories', CategoryController::class);

        /**
         * Routes Users
         */
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('users', UserController::class);

        /**
         * Routes Plan x Profiles
         */
        Route::get('profiles/{id}/plans', [PlanProfileController::class, 'index'])->name('profiles.plans.index');
        Route::any('profiles/{id}/plans/available', [PlanProfileController::class, 'available'])->name('profiles.plans.available');
        Route::post('profiles/{id}/plans/attach', [PlanProfileController::class, 'attach'])->name('profiles.plans.attach');
        Route::delete('profiles/{idProfile}/plans{idPlan}/attach', [PlanProfileController::class, 'detach'])->name('profiles.plans.detach');

        Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles.index');
        Route::any('plans/{id}/profiles/available', [PlanProfileController::class, 'profileAvailables'])->name('plans.profiles.available');
        Route::any('plans/{id}/profiles/attach', [PlanProfileController::class, 'profileAttach'])->name('plans.profiles.attach');
        Route::any('plans/{idPlan}/profiles/{idProfile}/detach', [PlanProfileController::class, 'profileDetach'])->name('plans.profiles.detach');

        /**
         * Routes Permission x Perfil
         */
        Route::post('profiles/{profileId}/permissions/{permissionId}/detach', [PermissionProfileController::class, 'detach'])->name('profiles.permissions.detach');
        Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attach'])->name('profiles.permissions.attach');
        Route::any('profiles/{id}/permissions/available', [PermissionProfileController::class, 'available'])->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions.index');
        Route::get('permissions/{id}/profiles', [PermissionProfileController::class, 'profiles'])->name('profiles.permissions.profiles.index');

        /**
         * Routes Permissions
         */
        Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
        Route::resource('permissions', PermissionController::class);

        /**
         * Routes Profiles
         */
        Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
        Route::resource('profiles', ProfileController::class);


        /**
         * Rotas Plan Details
         */
        Route::get('plans/{id}/detail', [DetailPlanController::class, 'index'])->name('detail.plans.index');
        Route::get('plans/{id}/detail/create', [DetailPlanController::class, 'create'])->name('detail.plans.create');
        Route::post('plans/{id}/detail', [DetailPlanController::class, 'store'])->name('detail.plans.store');
        Route::get('plans/{idPlan}/detail/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('detail.plans.edit');
        Route::put('plans/{idPlan}/detail/{idDetail}', [DetailPlanController::class, 'update'])->name('detail.plans.update');
        Route::get('plans/{idPlan}/detail/{idDetail}', [DetailPlanController::class, 'show'])->name('detail.plans.show');
        Route::delete('plans/{idPlan}/detail/{idDetail}', [DetailPlanController::class, 'destroy'])->name('detail.plans.destroy');


        /**
         * Rotas Plan
         */
        Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
        Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
        Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('plans/{id}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('plans/{id}', [PlanController::class, 'update'])->name('plans.update');
        Route::get('plans/{id}', [PlanController::class, 'show'])->name('plans.show');
        Route::delete('plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');

        /**
         * Dasboard - Home
         */
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
    });

require __DIR__ . '/auth.php';
