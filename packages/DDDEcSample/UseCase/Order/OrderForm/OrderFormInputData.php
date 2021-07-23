<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderForm;

/**
 * class OrderFormInputData
 * 
 */
class OrderFormInputData
{
  private $viewName = "";
  function __construct(string $viewName) {
    $this->viewName = $viewName;
  }
  public function getViewName() : string {
    return $this->viewName;
  }
}