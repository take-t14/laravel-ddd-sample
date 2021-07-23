<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Order\OrderCheck;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\ValidationViewData;
use  Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartViewData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class OrderCheckViewModel
 * 
 */
class OrderCheckViewModel implements Arrayable
{
  use ViewModelTrait;
  private $cart = null;
  private $validationViewData = null;
  function __construct(ValidationViewData $validationViewData, CartViewData $cart) {
    $this->cart = $cart;
    $this->validationViewData = $validationViewData;
  }
  public function getValidationViewData() : ValidationViewData {
    return $this->validationViewData;
  }
  public function getCart() : CartViewData {
    return $this->cart;
  }
}