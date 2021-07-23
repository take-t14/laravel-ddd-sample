<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\Number;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class PriceTaxIn
 * 
 */
class PriceTaxIn extends Number implements Arrayable
{
  use ViewModelTrait;
  function __construct(Price $price, TaxRate $taxRate) {
    $value = $price->getValue() + floor($price->getValue() * $taxRate->getValue() / 100);
    parent::__construct($value);
  }
}