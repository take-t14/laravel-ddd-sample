<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductDetail;

/**
 * class ProductDetailInputData
 * 
 */
class ProductDetailInputData
{
  private $viewName = "";
  private $productGroupId = "";
  function __construct(string $viewName, string $productGroupId) {
    $this->viewName = $viewName;
    $this->productGroupId = $productGroupId;
  }
  public function getViewName() : string {
    return $this->viewName;
  }
  public function getProductGroupId() : string {
    return $this->productGroupId;
  }
}