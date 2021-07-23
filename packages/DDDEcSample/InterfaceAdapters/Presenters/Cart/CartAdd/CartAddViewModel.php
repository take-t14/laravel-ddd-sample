<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartAdd;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartViewData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class CartAddViewModel
 * 
 */
class CartAddViewModel implements Arrayable
{
  use ViewModelTrait;
  private $cart = null;
  function __construct(CartViewData $cart) {
    $this->cart = $cart;
  }
  public function getCart() : CartViewData {
    return $this->cart;
  }
}