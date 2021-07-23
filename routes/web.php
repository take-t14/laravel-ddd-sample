<?php

use Illuminate\Support\Facades\Route;
use Packages\DDDEcSample\InterfaceAdapters\Controllers\{ProductController, CartController, OrderController};
use Packages\MvcSample\App\Http\Controllers\ProductController as MvcProductController;
use Packages\MvcSample\App\Http\Controllers\CartController as MvcCartController;
use Packages\MvcSample\App\Http\Controllers\OrderController as MvcOrderController;
use Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController as LightDDDProductController;
use Packages\LightDDDEcSample\InterfaceAdapters\Controllers\CartController as LightDDDCartController;
use Packages\LightDDDEcSample\InterfaceAdapters\Controllers\OrderController as LightDDDOrderController;

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
Route::get("/ddd/product/list", [ProductController::class, "list"])->name("product.list.list");
Route::get("/ddd/product/detail/{productGroupId}", [ProductController::class, "detail"])->name("product.detail.detail");
Route::get("/ddd/cart/show", [CartController::class, "list"])->name("cart.show.show");
Route::get("/ddd/order/form", [OrderController::class, "form"])->name("order.form.form");
Route::get("/ddd/order/save", [OrderController::class, "save"])->name("order.save.save");

Route::get("/lightddd/product/list", [LightDDDProductController::class, "list"])->name("product.list.list");
Route::get("/lightddd/product/detail/{productGroupId}", [LightDDDProductController::class, "detail"])->name("product.detail.detail");
Route::get("/lightddd/cart/show", [LightDDDCartController::class, "list"])->name("cart.show.show");
Route::get("/lightddd/order/form", [LightDDDOrderController::class, "form"])->name("order.form.form");
Route::get("/lightddd/order/save", [LightDDDOrderController::class, "save"])->name("order.save.save");

Route::get("/mvc/product/list", [MvcProductController::class, "list"])->name("product.list.list");
Route::get("/mvc/product/detail/{productGroupId}", [MvcProductController::class, "detail"])->name("product.detail.detail");
Route::get("/mvc/cart/show", [MvcCartController::class, "list"])->name("cart.show.show");
Route::get("/mvc/order/form", [MvcOrderController::class, "form"])->name("order.form.form");
Route::get("/mvc/order/save", [MvcOrderController::class, "save"])->name("order.save.save");
