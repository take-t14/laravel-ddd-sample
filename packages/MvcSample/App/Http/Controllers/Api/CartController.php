<?php
namespace Packages\MvcSample\App\Http\Controllers\Api;

use Packages\MvcSample\App\Http\Controllers\ControllerBase;
use ErrorException;

class CartController extends ControllerBase
{
	public function add() {
		$ret = null;
		if (!is_null(\RequestEx::get("isRemove")) 
		&& ("true" === \RequestEx::get("isRemove") || "1" === \RequestEx::get("isRemove"))) {
			\Packages\MvcSample\Models\Cart::removeCartItem((int)\RequestEx::get("productId"));
			$ret = \Packages\MvcSample\Models\Cart::getCart();
		} else if (!is_null(\RequestEx::get("isAllRemove"))
		&& ("true" === \RequestEx::get("isAllRemove")) || "1" === \RequestEx::get("isAllRemove")) {
			\Packages\MvcSample\Models\Cart::removeCartItemAll();
			$ret = \Packages\MvcSample\Models\Cart::getCart();
		} else {
			$ret = \Packages\MvcSample\Models\Cart::addCart(
				(int)\RequestEx::get("productId"), (int)\RequestEx::get("quantity"));
		}
		if (!isset($ret)) {
			throw new ErrorException("カートデータの取得に失敗しました");
		}
		$viewModel = ["cart" => $ret];
		return response()->json(compact("viewModel"));
	}
}
