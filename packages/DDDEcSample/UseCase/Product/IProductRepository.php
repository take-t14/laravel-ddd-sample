<?php
namespace Packages\DDDEcSample\UseCase\Product;

use Illuminate\Support\Collection;
//use Illuminate\Support\LazyCollection as Collection;
use Packages\DDDEcSample\Domain\Model\Product\Entity\{Product, ProductGroup};
use Packages\DDDEcSample\Domain\Model\Product\VO\{ProductId, ProductGroupId};

/**
 * class IProductRepository
 * 
 */
interface IProductRepository
{
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findAll() : Collection;
  /**
   * 
   *
   * @return Product
   * @abstract
   * @access public
   */
  public function findById(ProductId $productId) : ?Product;
  /**
   * 
   *
   * @return ProductGroup
   * @abstract
   * @access public
   */
  public function findByGroupId(ProductGroupId $productGroupId) : ?ProductGroup;
}