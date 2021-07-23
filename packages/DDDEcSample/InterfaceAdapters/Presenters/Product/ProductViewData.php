<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product;

use Packages\DDDEcSample\UseCase\Product\ProductUseCaseData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};

/**
 * class ProductViewData
 * 
 */
class ProductViewData implements Arrayable
{
  use ViewModelTrait;
  private $productId = null;
  private $productGroupId = null;
  private $productName = "";
  private $price = null;
  private $priceTaxIn = null;
  private $taxRate = null;
  private $color = null;
  private $size = null;
  function __construct(ProductUseCaseData $product) {
    $this->productId = new IntegerViewData($product->getProductId()->getValue());
    $this->productGroupId = new IntegerViewData($product->getProductGroupId()->getValue());
    $this->productName = new StringViewData($product->getProductName()->getValue());
    $this->price = new IntegerViewData($product->getPrice()->getValue());
    $this->priceTaxIn = new IntegerViewData($product->getPriceTaxIn()->getValue());
    $this->taxRate = new IntegerViewData($product->getTaxRate()->getValue());
    $this->color = new ColorViewData($product->getColor());
    $this->size = new SizeViewData($product->getSize());
  }
  public function getProductId() : IntegerViewData {
    return $this->productId;
  }
  public function getProductGroupId() : IntegerViewData {
    return $this->productGroupId;
  }
  public function getProductName() : StringViewData {
    return $this->productName;
  }
  public function getPrice() : IntegerViewData {
    return $this->price;
  }
  public function getPriceTaxIn() : IntegerViewData {
    return $this->priceTaxIn;
  }
  public function getTaxRate() : IntegerViewData {
    return $this->taxRate;
  }
  public function getColor() : ColorViewData {
    return $this->color;
  }
  public function getSize() : SizeViewData {
    return $this->size;
  }
}