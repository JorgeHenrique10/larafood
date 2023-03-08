<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {

    /**
     * Routes Register
     **/
    Route::post('clients', [RegisterController::class, 'store']);

    /**
     * Routes Products
     **/
    Route::get('products/category', [ProductController::class, 'productsCategory']);
    Route::get('products/{uuid}', [ProductController::class, 'show']);
    Route::get('products', [ProductController::class, 'index']);

    /**
     * Routes Tables
     **/
    Route::get('tables/{uuid}', [TableController::class, 'show']);
    Route::get('tables', [TableController::class, 'index']);

    /**
     * Routes Categories
     **/
    Route::get('categories/{uuid}', [CategoryController::class, 'show']);
    Route::get('categories', [CategoryController::class, 'index']);

    /**
     * Routes Tenant
     **/
    Route::get('tenants/{uuid}', [TenantController::class, 'show']);
    Route::get('tenants', [TenantController::class, 'index']);
});
