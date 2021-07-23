<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Illuminate\Support\Collection;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class OrderBase
 * 
 */
class OrderBase implements Arrayable
{
  use ViewModelTrait;
  /** @var Collection */
  protected $items = null;
  /** @var Total */
  protected $total = null;
  /** @var TotalTaxin */
  protected $totalTaxin = null;
  function __construct() {
    $this->items = new Collection();
    $this->calc();
  }
  public function getItems() : Collection {
    return $this->items;
  }
  public function getTotal() : Total {
    return $this->total;
  }
  public function getTotalTaxin() : TotalTaxin {
    return $this->totalTaxin;
  }
  public function calc() {
    $this->calcTotal();
    $this->calcTotalTaxIn();
  }
  private function calcTotal() {
    $this->total = new Total($this->getItems());
  }
  private function calcTotalTaxIn() {
    $this->totalTaxin = new TotalTaxin($this->getItems());
  }
}