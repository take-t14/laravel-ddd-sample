<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Presenters;

use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;

/**
 * class ViewModel
 * 
 */
class ViewModel
{
  /** @var OutputData */
  private $outputData = null;
  function __construct(OutputData $outputData) {
    $this->outputData = $outputData;
  }
  public function getViewModel() : array {
    $outputData = $this->outputData->toArray();
    return $outputData["outputDatas"];
  }
}