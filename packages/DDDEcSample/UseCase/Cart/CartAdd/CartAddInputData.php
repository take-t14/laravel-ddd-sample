<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartAdd;

/**
 * class CartAddInputData
 * 
 */
class CartAddInputData
{
  private $productId = "";
  private $quantity = "";
  private $isRemove = false;
  private $isAllRemove = false;
  function __construct(string $productId, string $quantity, string $isRemove, string $isAllRemove) {
    $this->productId = (int)$productId;
    $this->quantity = (int)$quantity;
    $isRemove = strtolower($isRemove);
    $this->isRemove = ("true" === $isRemove || "1" === $isRemove) ? true : false;
    $isAllRemove = strtolower($isAllRemove);
    $this->isAllRemove = ("true" === $isAllRemove || "1" === $isAllRemove) ? true : false;
  }
  public function getProductId() : string {
    return $this->productId;
  }
  public function getQuantity() : string {
    return $this->quantity;
  }
  public function getIsRemove() : bool {
    return $this->isRemove;
  }
  public function getIsAllRemove() : bool {
    return $this->isAllRemove;
  }
}