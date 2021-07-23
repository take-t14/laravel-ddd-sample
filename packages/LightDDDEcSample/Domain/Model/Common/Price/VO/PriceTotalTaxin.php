<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\Number;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class PriceTotalTaxin
 * 
 */
class PriceTotalTaxin extends Number implements Arrayable
{
  use ViewModelTrait;
  function __construct(PriceTaxIn $priceTaxIn, Quantity $quantity) {
    $value = $priceTaxIn->getValue() * $quantity->getValue();
    parent::__construct($value);
  }
}