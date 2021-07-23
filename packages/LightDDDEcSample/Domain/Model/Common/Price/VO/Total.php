<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Illuminate\Support\Collection;
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\OrderBaseItem;;
use Packages\LightDDDEcSample\Domain\Model\Common\VO\PositiveNumber;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class Total
 * 
 */
class Total extends PositiveNumber implements Arrayable
{
  use ViewModelTrait;
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