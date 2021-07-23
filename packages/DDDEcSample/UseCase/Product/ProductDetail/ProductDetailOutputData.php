<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductDetail;

use Packages\DDDEcSample\UseCase\Product\ProductGroupUseCaseData;
//use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection as Collection;

/**
 * class ProductDetailOutputData
 * 
 */
class ProductDetailOutputData
{
  private $inputData = null;
  private $productGroup = null;
  private $reviews = null;
  function __construct(ProductDetailInputData $inputData, ProductGroupUseCaseData $productGroup, Collection $reviews) {
    $this->inputData = $inputData;
    $this->productGroup = $productGroup;
    $this->reviews = $reviews;
  }
  public function getProductDetailInputData() : ProductDetailInputData {
    return $this->inputData;
  }
  public function getProductGroup() : ProductGroupUseCaseData {
    return $this->productGroup;
  }
  public function getReviews() : Collection {
    return $this->reviews;
  }
}