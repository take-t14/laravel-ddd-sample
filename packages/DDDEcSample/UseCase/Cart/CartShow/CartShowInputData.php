<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartShow;

/**
 * class CartShowInputData
 * 
 */
class CartShowInputData
{
  private $viewName = "";
  function __construct(string $viewName) {
    $this->viewName = $viewName;
  }
  public function getViewName() : string {
    return $this->viewName;
  }
}