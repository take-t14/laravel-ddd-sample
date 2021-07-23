<?php
namespace Packages\LightDDDEcSample\UseCase\Common\InputData;

/**
 * class InputData
 * 
 */
class InputData
{
  private $inputDatas = [];
  private $viewName = "";
  function __construct(array $inputDatas, string $viewName = "") {
    $this->inputDatas = $inputDatas;
    $this->viewName = $viewName;
  }
  public function getInputDatas() : array {
    return $this->inputDatas;
  }
  public function getValue(string $key) {
    /** @var InputDataBase $inputData */
    $inputData = $this->inputDatas[$key];
    return $inputData->getValue();
  }
  public function getViewName() : string {
    return $this->viewName;
  }
}