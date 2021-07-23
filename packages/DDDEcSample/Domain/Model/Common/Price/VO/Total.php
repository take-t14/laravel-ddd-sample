<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Price\VO;

use Illuminate\Support\Collection;
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\OrderBaseItem;;
use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class Total
 * 
 */
class Total extends PositiveNumber
{
  protected $value = 0;
  function __construct(Collection $items) {
    $value = 0;
    foreach($items as $item) {
      /** @var OrderBaseItem $items */
      $value += $item->getPriceTotal()->getValue();
    }
    parent::__construct($value, "total");
  }
}