<?php
namespace Packages\LightDDDEcSample\UseCase\Common\OutputData;

use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class OutputData
 * 
 */
class OutputData implements Arrayable
{
  use ViewModelTrait;
  private $inputData = null;
  private $outputDatas = [];
  function __construct(InputData $inputData, array $outputDatas) {
    $this->inputData = $inputData;
    $this->outputDatas = $outputDatas;
  }
  public function getInputData() : InputData {
    return $this->inputData;
  }
  public function getOutputDatas() : array {
    return $this->outputDatas;
  }
}