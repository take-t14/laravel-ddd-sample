<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Common;

use Packages\DDDEcSample\UseCase\Common\ValidationUseCaseData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ValidationViewData
 * 
 */
class ValidationViewData implements Arrayable
{
  use ViewModelTrait;
  private $errors = [];
  function __construct(ValidationUseCaseData $validationUseCaseData) {
    $this->errors = $validationUseCaseData->getErrors();
  }
  public function getErrors() : array {
    return $this->errors;
  }
}