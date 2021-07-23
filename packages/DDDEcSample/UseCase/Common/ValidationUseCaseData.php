<?php
namespace Packages\DDDEcSample\UseCase\Common;

use Packages\DDDEcSample\Domain\Model\Order\VO\ValidateError;

/**
 * class ValidationViewData
 * 
 */
class ValidationUseCaseData
{
  private $errors = [];
  function __construct(ValidateError $validateError) {
    $this->errors = $validateError->getErrors();
  }
  public function getErrors() : array {
    return $this->errors;
  }
}