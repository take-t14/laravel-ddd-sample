<?php
namespace Packages\DDDEcSample\Domain\Model\Product\Entity;

use Packages\DDDEcSample\Domain\Model\Product\VO\{ColorId, ColorName, ProductId, ProductName, ProductGroupId, SizeId, SizeName};
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Price, PriceTaxIn, TaxRate};

/**
 * class Product
 * 
 */
class Product
{
  /** @var ProductId */
  private $productId = null;
  /** @var ProductGroupId */
  private $productGroupId = null;
  /** @var ProductName */
  private $productName = null;
  /** @var Price */
  private $price = null;
  /** @var PriceTaxIn */
  private $priceTaxIn = null;
  /** @var TaxRate */
  private $taxRate = null;
  /** @var Color */
  private $color = null;
  /** @var Size */
  private $size = null;
  function __construct(ProductId $productId, ProductGroupId $productGroupId, ProductName $productName, Price $price, TaxRate $taxRate, Color $color, Size $size) {
    $this->productId = $productId;
    $this->productGroupId = $productGroupId;
    $this->productName = $productName;
    $this->price = $price;
    $this->priceTaxIn = new PriceTaxIn($price, $taxRate);
    $this->taxRate = $taxRate;
    $this->color = $color;
    $this->size = $size;
  }
  static function dbRecordToModel($dbRecord) : Product {
    return new Product(
        new ProductId($dbRecord->product_id)
      , new ProductGroupId($dbRecord->product_group_id)
      , new ProductName($dbRecord->product_name)
      , new Price($dbRecord->price)
      , new TaxRate($dbRecord->tax_rate)
      , new Color(new ColorId($dbRecord->color_id), new ColorName($dbRecord->color_name))
      , new Size(new SizeId($dbRecord->size_id), new SizeName($dbRecord->size_name))
    );
  }
  public function getProductId() : ProductId {
    return $this->productId;
  }
  public function getProductGroupId() : ProductGroupId {
    return $this->productGroupId;
  }
  public function getProductName() : ProductName {
    return $this->productName;
  }
  public function getPrice() : Price {
    return $this->price;
  }
  public function getPriceTaxIn() : PriceTaxIn {
    return $this->priceTaxIn;
  }
  public function getTaxRate() : TaxRate {
    return $this->taxRate;
  }
  public function getColor() : Color {
    return $this->color;
  }
  public function getSize() : Size {
    return $this->size;
  }
  public function equal(Product $other) : bool {
    return $other->getProductId()->equal($this->getProductId());
  }
}