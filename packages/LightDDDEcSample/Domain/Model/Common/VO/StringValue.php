<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class StringValue
 * 
 */
class StringValue implements Arrayable
{
  use ViewModelTrait;
  /** @var string */
  protected $value = null;
  function __construct(string $value, string $valueName = "StringValue"
    , string $strErrMsg = "文字を入力して下さい") {
    if ("" !== $valueName && "" !== $strErrMsg) {
      $validateException = new ValidateException($valueName);
      if ("" === $value) {
        $validateException = $validateException->addError($strErrMsg);
      }
      $validateException->throwIfErrorExist();
    }
    $this->value = $value;
  }
  function getValue() : string {
    return $this->value;
  }
}