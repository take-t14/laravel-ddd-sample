<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO;

use RuntimeException;
use Throwable;

/**
 * class ValidateException
 * 
 */
class ValidateException extends RuntimeException
{
  private $name = "";
  private $errors = [];
  function __construct(string $name, array $errors = [], $message = "", $code = 0, ?Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
    $this->name = $name;
    $this->errors = $errors;
  }
  public function getName() : string {
    return $this->name;
  }
  public function getErrors() : array {
    return $this->errors;
  }
  public function addError(string $error) : ValidateException {
    return new ValidateException(
         $this->getName()
      ,  array_merge($this->getErrors(), [$error])
      , $this->getMessage()
      , $this->getCode()
      , $this->getPrevious());
  }
  public function isErrorExist() :bool {
    if (0 < count($this->getErrors())) {
      return true;
    }
    return false;
  }
  public function throwIfErrorExist() {
    if (!$this->isErrorExist()) {
      return;
    }
    $message = $this->getMessage();
    if ("" === $message) {
      $message = $this->getErrors()[0];
    }
    throw new ValidateException(
        $this->getName()
      , $this->getErrors()
      , $message
      , $this->getCode()
      , $this->getPrevious());
    }
}