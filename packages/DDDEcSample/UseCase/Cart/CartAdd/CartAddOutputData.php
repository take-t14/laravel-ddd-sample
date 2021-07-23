<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartAdd;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;
use Packages\DDDEcSample\UseCase\Cart\CartUseCaseData;

/**
 * class CartAddOutputData
 * 
 */
class CartAddOutputData
{
  private $inputData = null;
  /** @var CartUseCaseData */
  private $cart = null;
  function __construct(CartAddInputData $inputData, ?Cart $cart) {
    $this->inputData = $inputData;
    $this->cart = new CartUseCaseData($cart);
  }
  public function getCartAddInputData() : CartAddInputData {
    return $this->inputData;
  }
  public function getCart() : CartUseCaseData {
    return $this->cart;
  }
}