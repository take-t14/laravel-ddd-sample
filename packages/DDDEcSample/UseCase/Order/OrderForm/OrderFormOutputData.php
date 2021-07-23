<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderForm;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;
use Packages\DDDEcSample\UseCase\Cart\CartUseCaseData;

/**
 * class OrderFormOutputData
 * 
 */
class OrderFormOutputData
{
  private $inputData = null;
  /** @var CartUseCaseData */
  private $cart = null;
  function __construct(OrderFormInputData $inputData, ?Cart $cart) {
    $this->inputData = $inputData;
    $this->cart = new CartUseCaseData($cart);
  }
  public function getOrderFormInputData() : OrderFormInputData {
    return $this->inputData;
  }
  public function getCart() : CartUseCaseData {
    return $this->cart;
  }
}