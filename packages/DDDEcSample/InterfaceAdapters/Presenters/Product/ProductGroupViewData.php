<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product;

use Illuminate\Support\Collection;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductViewData;
use Packages\DDDEcSample\UseCase\Product\{ProductGroupUseCaseData, ColorUseCaseData, SizeUseCaseData};
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};

/**
 * class ProductGroupViewData
 * 
 */
class ProductGroupViewData implements Arrayable
{
  use ViewModelTrait;
  private $productGroupId = null;
  private $productGroupName = null;
  private $products = [];
  private $lowPrice = null;
  private $heightPrice = null;
  private $lowPriceTaxIn = null;
  private $heightPriceTaxIn = null;
  private $colors = [];
  private $sizes = [];
  function __construct(ProductGroupUseCaseData $productGroup) {
    $this->productGroupId = new IntegerViewData($productGroup->getProductGroupId()->getValue());
    $this->productGroupName = new StringViewData($productGroup->getProductGroupName()->getValue());
    foreach($productGroup->getProducts() as $colorKey => $colorVal) {
      foreach($colorVal as $sizeKey => $sizeVal) {
        $this->products[$colorKey][$sizeKey] = new ProductViewData($sizeVal);
      }
    }
    $this->lowPrice = new IntegerViewData($productGroup->getLowPrice()->getValue());
    $this->heightPrice = new IntegerViewData($productGroup->getHeightPrice()->getValue());
    $this->lowPriceTaxIn = new IntegerViewData($productGroup->getLowPriceTaxIn()->getValue());
    $this->heightPriceTaxIn = new IntegerViewData($productGroup->getHeightPriceTaxIn()->getValue());
    foreach($productGroup->getColors() as $color) {
      $this->colors[] = new ColorViewData($color);
    }
    foreach($productGroup->getSizes() as $size) {
      $this->sizes[] = new SizeViewData($size);
    }
  }
  function getProductGroupId() : IntegerViewData {
    return $this->productGroupId;
  }
  function getProductGroupName() : StringViewData {
    return $this->productGroupName;
  }
  function getProducts() : array {
    return $this->products;
  }
  function getLowPrice() : IntegerViewData {
    return $this->lowPrice;
  }
  function getHeightPrice() : IntegerViewData {
    return $this->heightPrice;
  }
  function getLowPriceTaxIn() : IntegerViewData {
    return $this->lowPriceTaxIn;
  }
  function getHeightPriceTaxIn() : IntegerViewData {
    return $this->heightPriceTaxIn;
  }
  function getColors() : array {
    return $this->colors;
  }
  function getSizes() : array {
    return $this->sizes;
  }
}