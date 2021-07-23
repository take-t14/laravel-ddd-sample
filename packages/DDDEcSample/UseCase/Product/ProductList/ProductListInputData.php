<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductList;

/**
 * class ProductListInputData
 * 
 */
class ProductListInputData
{
  private $viewName = "";
  function __construct(string $viewName) {
    $this->viewName = $viewName;
  }
  public function getViewName() : string {
    return $this->viewName;
  }
}