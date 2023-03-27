<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EvaluationOrderController;
use App\Http\Controllers\Api\OrderController;
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


/**
 * Routes Register
 **/
Route::post('auth/register', [RegisterController::class, 'store']);
Route::post('auth/token', [AuthController::class, 'auth']);

/**
 * Routes Authenticates
 */

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'auth'
], function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('evaluationOrders/order/{identifyOrder}', [EvaluationOrderController::class, 'evaluationsByOrderIdentify']);
    Route::get('evaluationOrders/{id}', [EvaluationOrderController::class, 'show']);
    Route::post('evaluationOrders', [EvaluationOrderController::class, 'store']);
    Route::get('v1/orders/me', [OrderController::class, 'myOrders']);
    Route::post('v1/orders', [OrderController::class, 'store']);
});

/**
 * Routes Public
 */

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {

    /**
     * Routes Orders
     **/
    Route::get('orders/{identify}', [OrderController::class, 'show']);
    Route::post('orders', [OrderController::class, 'store']);

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
