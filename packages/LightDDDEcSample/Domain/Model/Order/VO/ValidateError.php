<?php
namespace Packages\LightDDDEcSample\Domain\Model\Order\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\{ValidateExceptionCollection, ValidateException};
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ValidateError
 * 
 */
class ValidateError implements Arrayable
{
  use ViewModelTrait;
  private $errors = [];
  function __construct(array $errors = []) {
    $this->errors = $errors;
  }
  public function getErrors() : array {
    return $this->errors;
  }
  public function addError(string $columnName, string $error) : ValidateError {
    $newError = $this->errors;
    if (!isset($newError[$columnName])) {
      $newError[$columnName] = [$error];
    } else {
      $newError[$columnName] = array_merge($this->errors[$columnName], [$error]);
    }
    return new ValidateError($newError);
  }
  public function addErrors(string $columnName, array $errors) : ValidateError {
    $newError = $this->errors;
    if (!isset($newError[$columnName])) {
      $newError[$columnName] = $errors;
    } else {
      $newError[$columnName] = array_merge($this->errors[$columnName], $errors);
    }
    return new ValidateError($newError);
  }
  public function addErrorsByExCollection(ValidateExceptionCollection $exCollection) : ValidateError {
    $varidateError = $this;
    foreach($exCollection->getExceptions() as $exception) {
      /** @var ValidateException $exception */
      $varidateError = $varidateError->addErrors($exception->getName(), $exception->getErrors());
    }
    return $varidateError;
  }
  public function merge(ValidateError $validateError) : ValidateError {
    $newError = $this->errors;
    foreach($validateError->getErrors() as $key => $val) {
      if (!isset($newError[$key])) {
        $newError[$key] = $val;
      } else {
        $newError[$key] = array_merge($this->errors[$key], $val);
      }
    }
    return new ValidateError($newError);
  }
  public function isExistError() : bool {
    return 0 < count($this->errors);
  }
}