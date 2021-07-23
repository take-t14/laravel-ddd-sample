<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\{CartController, OrderController};
use Packages\MvcSample\App\Http\Controllers\Api\CartController as MvcCartController;
use Packages\MvcSample\App\Http\Controllers\Api\OrderController as MvcOrderController;
use Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\CartController as LightDDDCartController;
use Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController as LightDDDOrderController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/ddd/cart/add", [CartController::class, "add"]);
Route::post("/ddd/order/check", [OrderController::class, "check"]);
Route::post("/ddd/order/save", [OrderController::class, "save"]);

Route::post("/mvc/cart/add", [MvcCartController::class, "add"]);
Route::post("/mvc/order/check", [MvcOrderController::class, "check"]);
Route::post("/mvc/order/save", [MvcOrderController::class, "save"]);

Route::post("/lightddd/cart/add", [LightDDDCartController::class, "add"]);
Route::post("/lightddd/order/check", [LightDDDOrderController::class, "check"]);
Route::post("/lightddd/order/save", [LightDDDOrderController::class, "save"]);
