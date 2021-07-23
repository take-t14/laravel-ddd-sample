<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\Number;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class Quantity
 * 
 */
class Quantity extends Number implements Arrayable
{
  use ViewModelTrait;
  function __construct(int $value) {
    parent::__construct($value);
  }
}