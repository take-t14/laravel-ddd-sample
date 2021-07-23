<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderSave;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;
use Packages\DDDEcSample\UseCase\Cart\CartUseCaseData;
use Packages\DDDEcSample\UseCase\Common\ValidationUseCaseData;

/**
 * class OrderSaveOutputData
 * 
 */
class OrderSaveOutputData
{
  private $inputData = null;
  /** @var CartUseCaseData */
  private $cart = null;
  /** @var ValidationUseCaseData */
  private $validationUseCaseData = null;
  function __construct(OrderSaveInputData $inputData, ValidationUseCaseData $validationUseCaseData, Cart $cart) {
    $this->inputData = $inputData;
    $this->cart = new CartUseCaseData($cart);
    $this->validationUseCaseData = $validationUseCaseData;
  }
  public function getOrderSaveInputData() : OrderSaveInputData {
    return $this->inputData;
  }
  public function getCart() : CartUseCaseData {
    return $this->cart;
  }
  public function getValidationUseCaseData() : ValidationUseCaseData {
    return $this->validationUseCaseData;
  }
}