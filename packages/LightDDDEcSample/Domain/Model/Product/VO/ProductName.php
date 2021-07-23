<?php
namespace Packages\LightDDDEcSample\Domain\Model\Product\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\StringValue;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ProductName
 * 
 */
class ProductName extends StringValue implements Arrayable
{
  use ViewModelTrait;
  function __construct(string $value) {
    parent::__construct($value, "");
  }
}