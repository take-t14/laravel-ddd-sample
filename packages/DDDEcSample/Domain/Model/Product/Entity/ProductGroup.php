<?php
namespace Packages\DDDEcSample\Domain\Model\Product\Entity;

use Packages\DDDEcSample\Domain\Model\Product\Entity\{Color, Size};
use Packages\DDDEcSample\Domain\Model\Product\VO\{ColorId, ColorName, ProductGroupId, ProductGroupName, SizeId, SizeName};
use Illuminate\Support\Collection;
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Price, PriceTaxIn, TaxRate};

/**
 * class ProductGroup
 * 
 */
class ProductGroup
{
  /** @var ProductGroupId */
  private $productGroupId = null;
  /** @var ProductGroupName */
  private $productGroupName = null;
  /** @var array */
  private $products = [];
  /** @var Price */
  private $lowPrice = null;
  /** @var Price */
  private $heightPrice = null;
  /** @var PriceTaxIn */
  private $lowPriceTaxIn = null;
  /** @var PriceTaxIn */
  private $heightPriceTaxIn = null;
  /** @var array */
  private $colors = [];
  /** @var array */
  private $sizes = [];
  function __construct(ProductGroupId $productGroupId, ProductGroupName $productGroupName) {
    $this->productGroupId = $productGroupId;
    $this->productGroupName = $productGroupName;
    $this->products = [];
    $this->colors = [];
    $this->sizes = [];
  }
  public function getProductGroupId() : ProductGroupId {
    return $this->productGroupId;
  }
  public function getProductGroupName() : ProductGroupName {
    return $this->productGroupName;
  }
  public function addProduct(Product $product) {
    if (is_null($this->lowPrice) || $product->getPrice()->lessThan($this->lowPrice)) {
      $this->lowPrice = $product->getPrice();
      $this->lowPriceTaxIn = $product->getPriceTaxIn();
    }
    if (is_null($this->heightPrice) || $product->getPrice()->greaterThan($this->heightPrice)) {
      $this->heightPrice = $product->getPrice();
      $this->heightPriceTaxIn = $product->getPriceTaxIn();
    }
    $this->colors[$product->getColor()->getColorId()->getValue()] = $product->getColor();
    $this->sizes[$product->getSize()->getSizeId()->getValue()] = $product->getSize();
    $colorName = $product->getColor()->getColorName()->getValue();
    $sizeName = $product->getSize()->getSizeName()->getValue();
    $this->products[$colorName][$sizeName] = $product;
  }
  public function addProductFromDbRecord($product) {
    if (is_null($this->lowPrice) || $this->lowPrice->getValue() > $product->price) {
      $this->lowPrice = new Price($product->price);
      $this->lowPriceTaxIn = new PriceTaxIn(
        new Price($product->price), new TaxRate($product->tax_rate));
    }
    if (is_null($this->heightPrice) || $this->heightPrice->getValue() < $product->price) {
      $this->heightPrice = new Price($product->price);
      $this->heightPriceTaxIn = new PriceTaxIn(
        new Price($product->price), new TaxRate($product->tax_rate));
    }
    $this->colors[$product->color_id] = new Color(new ColorId($product->color_id), new ColorName($product->color_name));
    $this->sizes[$product->size_id] = new Size(new SizeId($product->size_id), new SizeName($product->size_name));
  }
  public function getProducts() : array {
    return $this->products;
  }
  public function getLowPrice() : Price {
    return $this->lowPrice;
  }
  public function getHeightPrice() : Price {
    return $this->heightPrice;
  }
  public function getLowPriceTaxIn() : PriceTaxIn {
    return $this->lowPriceTaxIn;
  }
  public function getHeightPriceTaxIn() : PriceTaxIn {
    return $this->heightPriceTaxIn;
  }
  public function getColors() : array {
    return $this->colors;
  }
  public function getSizes() : array {
    return $this->sizes;
  }
}