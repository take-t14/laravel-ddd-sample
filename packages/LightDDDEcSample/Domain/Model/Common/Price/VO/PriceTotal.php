<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\Number;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class PriceTotal
 * 
 */
class PriceTotal extends Number implements Arrayable
{
  use ViewModelTrait;
  function __construct(Price $price, Quantity $quantity) {
    $value = $price->getValue() * $quantity->getValue();
    parent::__construct($value);
  }
}