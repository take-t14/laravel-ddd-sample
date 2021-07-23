<?php
namespace Packages\LightDDDEcSample\Domain\Model\Product\Entity;

use Packages\LightDDDEcSample\Domain\Model\Product\VO\{SizeId, SizeName};
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class Size
 * 
 */
class Size implements Arrayable
{
  use ViewModelTrait;
  /** @var SizeId */
  private $sizeId = null;
  /** @var SizeName */
  private $sizeName = null;
  function __construct(SizeId $sizeId, SizeName $sizeName) {
    $this->sizeId = $sizeId;
    $this->sizeName = $sizeName;
  }
  public function getSizeId() : SizeId {
    return $this->sizeId;
  }
  public function getSizeName() : SizeName {
    return $this->sizeName;
  }
}