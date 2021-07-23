<?php
namespace Packages\LightDDDEcSample\Domain\Model\Product\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\PositiveNumber;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class SizeId
 * 
 */
class SizeId extends PositiveNumber implements Arrayable
{
  use ViewModelTrait;
  function __construct(string $value) {
    parent::__construct($value, "sizeId");
  }
}