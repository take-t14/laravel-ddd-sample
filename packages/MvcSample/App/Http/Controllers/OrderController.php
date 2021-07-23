<?php
namespace Packages\MvcSample\App\Http\Controllers;

use Packages\MvcSample\App\Http\Controllers\ControllerBase;

class OrderController extends ControllerBase
{
    public function form() {
		return $this->getView(
            "viewModel", ["cart" => \Packages\MvcSample\Models\Cart::getCart()]
        );
    }
}
