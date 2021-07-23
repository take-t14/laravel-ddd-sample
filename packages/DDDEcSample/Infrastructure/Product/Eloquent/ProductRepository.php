<?php
namespace Packages\DDDEcSample\Infrastructure\Product\Eloquent;

use Packages\DDDEcSample\UseCase\Product\IProductRepository;
use Illuminate\Support\Collection;
//use Illuminate\Support\LazyCollection as Collection;
use App\Models\Product as ProductModel;
use Packages\DDDEcSample\Domain\Model\Product\Entity\{Product, ProductGroup};
use Packages\DDDEcSample\Domain\Model\Product\VO\{ProductId, ProductGroupId, ProductName, Price, ProductGroupName};

/**
 * class ProductRepository
 * 
 */
class ProductRepository implements IProductRepository
{
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findAll() : Collection {
    $products = \DB::table('test_schema.product');
    $products->join("test_schema.product_group", "product.product_group_id", "=", "product_group.product_group_id");
    $products->join("test_schema.color", "product.color_id", "=", "color.color_id");
    $products->join("test_schema.size", "product.size_id", "=", "size.size_id");
    $products->orderBy("product.product_group_id", "ASC");
    $products->orderBy("product.color_id", "ASC");
    $products->orderBy("product.size_id", "ASC");
    $products->orderBy("product.product_id", "ASC");
    return $this->createProductGroupCollection($products->cursor(), false);
  }
  /**
   * 
   *
   * @return Product
   * @abstract
   * @access public
   */
  public function findById(ProductId $productId) : ?Product {
    $productQuery = \DB::table('test_schema.product');
    $productQuery->join("test_schema.product_group", "product.product_group_id", "=", "product_group.product_group_id");
    $productQuery->join("test_schema.color", "product.color_id", "=", "color.color_id");
    $productQuery->join("test_schema.size", "product.size_id", "=", "size.size_id");
    $productQuery->where("product.product_id", "=", $productId->getValue());
    $product = $productQuery->first();
    if (!isset($product)) {
      return null;
    }
    return Product::dbRecordToModel($product);
  }
  /**
   * 
   *
   * @return ProductGroup
   * @abstract
   * @access public
   */
  public function findByGroupId(ProductGroupId $productGroupId) : ?ProductGroup {
    $productsQuery = \DB::table('test_schema.product');
    $productsQuery->join("test_schema.product_group", "product.product_group_id", "=", "product_group.product_group_id");
    $productsQuery->join("test_schema.color", "product.color_id", "=", "color.color_id");
    $productsQuery->join("test_schema.size", "product.size_id", "=", "size.size_id");
    $productsQuery->where("product.product_group_id", "=", $productGroupId->getValue());
    $productsQuery->orderBy("product.product_group_id", "ASC");
    $productsQuery->orderBy("product.color_id", "ASC");
    $productsQuery->orderBy("product.size_id", "ASC");
    $productsQuery->orderBy("product.product_id", "ASC");
    return $this->createProductGroupCollection($productsQuery->cursor())->first();
  }
  private function createProductGroupCollection($products, bool $newProduct = true) : Collection {
    $productGroups = new Collection();
    /** @var ProductGroup $productGroup  */
    $productGroup = null;
    foreach($products as $product) {
      if (is_null($productGroup) || $productGroup->getProductGroupId()->getValue() !== $product->product_group_id) {
        $productGroup = new ProductGroup(
          new ProductGroupId($product->product_group_id)
        , new ProductGroupName($product->product_group_name));
        $productGroups->push($productGroup);
      }
      if ($newProduct) {
        $productGroup->addProduct(Product::dbRecordToModel($product));
      } else {
        $productGroup->addProductFromDbRecord($product);
      }
    }
    return $productGroups;
  }
}