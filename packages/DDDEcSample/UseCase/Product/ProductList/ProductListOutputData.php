<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductList;

use Illuminate\Support\Collection;
//use Illuminate\Support\LazyCollection as Collection;

/**
 * class ProductListOutputData
 * 
 */
class ProductListOutputData
{
  private $inputData = null;
  private $productGroups = null;
  function __construct(ProductListInputData $inputData, Collection $productGroups) {
    $this->inputData = $inputData;
    $this->productGroups = $productGroups;
  }
  public function getProductListInputData() : ProductListInputData {
    return $this->inputData;
  }
  public function getProductGroups() : Collection {
    return $this->productGroups;
  }
}