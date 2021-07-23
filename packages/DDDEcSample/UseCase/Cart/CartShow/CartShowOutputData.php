<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartShow;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;
use Packages\DDDEcSample\UseCase\Cart\CartUseCaseData;

/**
 * class CartShowOutputData
 * 
 */
class CartShowOutputData
{
  private $inputData = null;
  /** @var CartUseCaseData */
  private $cart = null;
  function __construct(CartShowInputData $inputData, ?Cart $cart) {
    $this->inputData = $inputData;
    $this->cart = new CartUseCaseData($cart);
  }
  public function getCartShowInputData() : CartShowInputData {
    return $this->inputData;
  }
  public function getCart() : CartUseCaseData {
    return $this->cart;
  }
}