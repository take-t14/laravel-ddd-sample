<?php
namespace Packages\DDDEcSample\UseCase\Product;

use Packages\DDDEcSample\Domain\Model\Product\Entity\Product;
use Packages\DDDEcSample\UseCase\Common\{IntegerUseCaseData, StringUseCaseData};
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ProductUseCaseData
 * 
 */
class ProductUseCaseData implements Arrayable
{
  use ViewModelTrait;
  private $productId = null;
  private $productGroupId = null;
  private $productName = null;
  private $price = null;
  private $priceTaxIn;
  private $taxRate = null;
  private $color = null;
  private $size = null;
  function __construct(?Product $product) {
    if (!isset($product)) {
      return;
    }
    $this->productId = new IntegerUseCaseData($product->getProductId()->getValue());
    $this->productGroupId = new IntegerUseCaseData($product->getProductGroupId()->getValue());
    $this->productName = new StringUseCaseData($product->getProductName()->getValue());
    $this->price = new IntegerUseCaseData($product->getPrice()->getValue());
    $this->priceTaxIn = new IntegerUseCaseData($product->getPriceTaxIn()->getValue());
    $this->taxRate = new IntegerUseCaseData($product->getTaxRate()->getValue());
    $this->color = new ColorUseCaseData($product->getColor());
    $this->size = new SizeUseCaseData($product->getSize());
  }
  public function getProductId() : IntegerUseCaseData {
    return $this->productId;
  }
  public function getProductGroupId() : IntegerUseCaseData {
    return $this->productGroupId;
  }
  public function getProductName() : StringUseCaseData {
    return $this->productName;
  }
  public function getPrice() : IntegerUseCaseData {
    return $this->price;
  }
  public function getPriceTaxIn() : IntegerUseCaseData {
    return $this->priceTaxIn;
  }
  public function getTaxRate() : IntegerUseCaseData {
    return $this->taxRate;
  }
  public function getColor() : ColorUseCaseData {
    return $this->color;
  }
  public function getSize() : SizeUseCaseData {
    return $this->size;
  }
}