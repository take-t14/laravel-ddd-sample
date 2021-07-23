<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO;

use RuntimeException;
use Throwable;

/**
 * class ValidateExceptionCollection
 * 
 */
class ValidateExceptionCollection extends RuntimeException
{
  private $exceptions = [];
  function __construct(array $exceptions = [], $message = "", $code = 0, ?Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
    $this->exceptions = $exceptions;
  }
  public function getExceptions() : array {
    return $this->exceptions;
  }
  public function addException(ValidateException $exception) : ValidateExceptionCollection {
    return new ValidateExceptionCollection(
         array_merge($this->getExceptions(), [$exception])
      , $this->getMessageEx()
      , $this->getCode()
      , $this->getPrevious());
  }
  public function getMessageEx() : string {
    if ("" !== $this->getMessage()) {
      return $this->getMessage();
    }
    $message = "";
    foreach($this->getExceptions() as $exception) {
      /** @var ValidateException $exception */
      if ("" !== $exception->getMessage()) {
        $message = $exception->getMessage();
        break;
      }
      if ($exception->isErrorExist()) {
        $message = ($exception->getErrors())[0];
        break;
      }
    }
    return $message;
  }
  public function isErrorExist() :bool {
    if (0 < count($this->getExceptions())) {
      return true;
    }
    return false;
  }
  public function throwIfErrorExist() {
    if (!$this->isErrorExist()) {
      return;
    }
    throw new ValidateExceptionCollection(
        $this->getExceptions()
      , $this->getMessageEx()
      , $this->getCode()
      , $this->getPrevious());
    }
}