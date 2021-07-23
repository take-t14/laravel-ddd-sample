<?php
namespace Packages\DDDEcSample\UseCase\Order;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};
use Packages\DDDEcSample\Domain\Model\Order\Entity\OrderItem;
use Packages\DDDEcSample\UseCase\Product\ProductUseCaseData;

/**
 * class OrderItemUseCaseData
 * 
 */
class OrderItemUseCaseData implements Arrayable
{
  use ViewModelTrait;
  /** @var IntegerViewData */
  private $orderTableId = null;
  /** @var IntegerViewData */
  private $quantity = null;
  /** @var IntegerViewData */
  private $taxRate = null;
  /** @var IntegerViewData */
  private $price = null;
  /** @var IntegerViewData */
  private $priceTotal = null;
  /** @var IntegerViewData */
  private $priceTaxIn = null;
  /** @var IntegerViewData */
  private $priceTotalTaxin = null;
  /** @var ProductUseCaseData */
  private $product = null;
  function __construct(OrderItem $orderItem) {
    $this->orderTableId = new IntegerViewData($orderItem->getOrderTableId()->getValue());
    $this->quantity = new IntegerViewData($orderItem->getQuantity()->getValue());
    $this->taxRate = new IntegerViewData($orderItem->getTaxRate()->getValue());
    $this->price = new IntegerViewData($orderItem->getPrice()->getValue());
    $this->priceTotal = new IntegerViewData($orderItem->getPriceTotal()->getValue());
    $this->priceTaxIn = new IntegerViewData($orderItem->getPriceTaxIn()->getValue());
    $this->priceTotalTaxin = new IntegerViewData($orderItem->getPriceTotalTaxin()->getValue());
    $this->product = new ProductUseCaseData($orderItem->getProduct());
  }
  public function getOrderTableId() : IntegerViewData {
    return $this->orderTableId;
  }
  public function getQuantity() : IntegerViewData {
    return $this->quantity;
  }
  public function getTaxRate() : IntegerViewData {
    return $this->taxRate;
  }
  public function getPrice() : IntegerViewData {
    return $this->price;
  }
  public function getPriceTotal() : IntegerViewData {
    return $this->priceTotal;
  }
  public function getPriceTaxIn() : IntegerViewData {
    return $this->priceTaxIn;
  }
  public function getPriceTotalTaxin() : IntegerViewData {
    return $this->priceTotalTaxin;
  }
  public function getProduct() : ProductUseCaseData {
    return $this->product;
  }
}