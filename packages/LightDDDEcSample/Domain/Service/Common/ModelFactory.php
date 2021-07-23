<?php
namespace Packages\LightDDDEcSample\Domain\Service\Common;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\{ValidateException, ValidateExceptionCollection};

class ModelFactoryItem
{
  private $className = "";
  private $params = [];
  private $instance = null;
  function __construct(string $className, array $params = [], $instance = null) {
    $validateException = new ValidateException("first_name");
    if ("" === $className) {
      $validateException->addError("クラス名を指定して下さい");
      $validateException->throwIfErrorExist();
    }
    $this->className = $className;
    $this->params = $params;
    $this->instance = $instance;
  }
  public function getClassName() : string {
    return $this->className;
  }
  public function getParams() : array {
    return $this->params;
  }
  public function getInstance() {
    return $this->instance;
  }
}

/**
 * class ModelFactory
 * 
 */
class ModelFactory
{
  private $modelFactoryItems = [];
  /** @var ValidateExceptionCollection */
  private $validateErrors = null;
  function __construct(array $modelFactoryItems) {
    $this->validateErrors = new ValidateExceptionCollection();
    $newModelFactoryItems = [];
    foreach($modelFactoryItems as $key => $modelFactoryItem) {
      /** @var ModelFactoryItem $modelFactoryItem */
      try {
        $instance = resolve($modelFactoryItem->getClassName(), $modelFactoryItem->getParams());
        $newModelFactoryItems[] = new ModelFactoryItem(
          $modelFactoryItem->getClassName(), $modelFactoryItem->getParams(), $instance);
      } catch(ValidateException $err) {
        $this->validateErrors = $this->validateErrors->addException($err);
      }
    }
    $this->validateErrors->throwIfErrorExist();
    $this->modelFactoryItems = $newModelFactoryItems;
  }
  public function getModelInstance(string $className) {
    foreach($this->modelFactoryItems as $modelFactoryItem) {
      /** @var ModelFactoryItem $modelFactoryItem */
      if ($modelFactoryItem->getClassName() === $className) {
        return $modelFactoryItem->getInstance();
      }
    }
  }
}