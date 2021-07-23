<?php
namespace Packages\DDDEcSample\UseCase\Product;

use Packages\DDDEcSample\Domain\Model\Product\Entity\{ProductGroup};
use Packages\DDDEcSample\UseCase\Common\{IntegerUseCaseData, StringUseCaseData};

/**
 * class ProductGroupUseCaseData
 * 
 */
class ProductGroupUseCaseData
{
  private $productGroupId = null;
  private $productGroupName = null;
  private $products = [];
  private $lowPrice = null;
  private $heightPrice = null;
  private $lowPriceTaxIn = null;
  private $heightPriceTaxIn = null;
  private $colors = [];
  private $sizes = [];
  function __construct(ProductGroup $productGroup) {
    $this->productGroupId = new IntegerUseCaseData($productGroup->getProductGroupId()->getValue());
    $this->productGroupName = new StringUseCaseData($productGroup->getProductGroupName()->getValue());
    foreach($productGroup->getProducts() as $colorKey => $colorVal) {
      foreach($colorVal as $sizeKey => $sizeVal) {
        $this->products[$colorKey][$sizeKey] = new ProductUseCaseData($sizeVal);
      }
    }
    $this->lowPrice = new IntegerUseCaseData($productGroup->getLowPrice()->getValue());
    $this->heightPrice = new IntegerUseCaseData($productGroup->getHeightPrice()->getValue());
    $this->lowPriceTaxIn = new IntegerUseCaseData($productGroup->getLowPriceTaxIn()->getValue());
    $this->heightPriceTaxIn = new IntegerUseCaseData($productGroup->getHeightPriceTaxIn()->getValue());
    foreach($productGroup->getColors() as $color) {
      $this->colors[] = new ColorUseCaseData($color);
    }
    foreach($productGroup->getSizes() as $size) {
      $this->sizes[] = new SizeUseCaseData($size);
    }
  }
  function getProductGroupId() : IntegerUseCaseData {
    return $this->productGroupId;
  }
  function getProductGroupName() : StringUseCaseData {
    return $this->productGroupName;
  }
  function getProducts() : array {
    return $this->products;
  }
  function getLowPrice() : IntegerUseCaseData {
    return $this->lowPrice;
  }
  function getHeightPrice() : IntegerUseCaseData {
    return $this->heightPrice;
  }
  function getLowPriceTaxIn() : IntegerUseCaseData {
    return $this->lowPriceTaxIn;
  }
  function getHeightPriceTaxIn() : IntegerUseCaseData {
    return $this->heightPriceTaxIn;
  }
  function getColors() : array {
    return $this->colors;
  }
  function getSizes() : array {
    return $this->sizes;
  }
}