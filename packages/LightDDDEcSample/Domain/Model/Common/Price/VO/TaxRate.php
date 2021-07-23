<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\PositiveNumber;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class TaxRate
 * 
 */
class TaxRate extends PositiveNumber implements Arrayable
{
  use ViewModelTrait;
  function __construct(int $value) {
    parent::__construct($value, "taxRate");
  }
}