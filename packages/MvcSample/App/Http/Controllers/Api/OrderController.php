<?php
namespace Packages\MvcSample\App\Http\Controllers\Api;

use Packages\MvcSample\App\Http\Controllers\{ControllerBase, MyObject};
use Packages\MvcSample\App\Http\Requests\OrderFormRequest;
use Packages\MvcSample\App\Libs\Mail\OrderNotification;
use RuntimeException;

class OrderController extends ControllerBase
{
    public function check(OrderFormRequest $orderFormRequest) {
        $cart = \Packages\MvcSample\Models\Cart::getCart();
        if (is_null($cart["cartId"]) || 0 >= count($cart["items"])) {
            throw new RuntimeException("カートが空です");
        }
        return response()->json(["cart" => $cart]);
    }
    public function save(OrderFormRequest $orderFormRequest) {
        $cart = \Packages\MvcSample\Models\Cart::getCart();
        if (is_null($cart["cartId"]) || 0 >= count($cart["items"])) {
            throw new RuntimeException("カートが空です");
        }
        $orderTable = \Packages\MvcSample\Models\OrderTable::saveOrder($cart);
        $order = \Packages\MvcSample\Models\OrderTable::orderDbToViewModel($orderTable);
        $orderNotification = new OrderNotification();
        $orderNotification->notify($order);
        return response()->json(["cart" => $cart]);
    }
}
