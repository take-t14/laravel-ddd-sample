<?php
namespace Packages\LightDDDEcSample\Domain\Model\Order\Entity;

use Packages\LightDDDEcSample\Domain\Model\Order\VO\{OrderTableId};
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\{Price, Quantity, TaxRate};
use Packages\LightDDDEcSample\Domain\Model\Product\Entity\{Product};
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\OrderBaseItem;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class OrderItem
 * 
 */
class OrderItem extends OrderBaseItem implements Arrayable
{
  use ViewModelTrait;
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