<?php
namespace Packages\DDDEcSample\UseCase\Review;

//use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection as Collection;
use Packages\DDDEcSample\Domain\Model\Product\VO\{ProductId, ProductGroupId};

/**
 * class IReviewRepository
 * 
 */
interface IReviewRepository
{
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findByProductId(ProductId $objProductId) : Collection;
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findByProductGroupId(ProductGroupId $productGroupId) : Collection;
}