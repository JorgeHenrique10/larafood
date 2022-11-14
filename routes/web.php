<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanController;
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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

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
        Route::get('/', [PlanController::class, 'index'])->name('admin.index');
    });

require __DIR__ . '/auth.php';
