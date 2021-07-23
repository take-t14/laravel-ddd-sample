<?php
namespace Packages\MvcSample\App\Http\Controllers;

use Packages\MvcSample\App\Http\Controllers\ControllerBase;

class CartController extends ControllerBase
{
    public function list() {
		return $this->getView(
            "viewModel", ["cart" => \Packages\MvcSample\Models\Cart::getCart()]
        );
    }
}
