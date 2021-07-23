<?php
namespace Packages\DDDEcSample\Domain\Model\Order\Entity;

use Packages\DDDEcSample\Domain\Model\Order\VO\{OrderTableId};
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Price, Quantity, TaxRate};
use Packages\DDDEcSample\Domain\Model\Product\Entity\{Product};
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\OrderBaseItem;

/**
 * class OrderItem
 * 
 */
class OrderItem extends OrderBaseItem
{
  /** @var OrderTableId */
  private $orderTableId = null;
  /** @var Product */
  private $product = null;
  function __construct(?OrderTableId $orderTableId, Product $product, Quantity $quantity
    , TaxRate $taxRate, Price $price) {
    parent::__construct($quantity, $taxRate, $price);
    $this->orderTableId = $orderTableId;
    $this->product = $product;
  }
  public function getOrderTableId() : OrderTableId {
    return $this->orderTableId;
  }
  public function getProduct() : Product {
    return $this->product;
  }
}