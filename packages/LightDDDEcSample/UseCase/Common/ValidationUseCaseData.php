<?php
namespace Packages\LightDDDEcSample\UseCase\Common;

use Packages\LightDDDEcSample\Domain\Model\Order\VO\ValidateError;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ValidationViewData
 * 
 */
class ValidationUseCaseData implements Arrayable
{
  use ViewModelTrait;
  private $errors = [];
  function __construct(ValidateError $validateError) {
    $this->errors = $validateError->getErrors();
  }
  public function getErrors() : array {
    return $this->errors;
  }
}