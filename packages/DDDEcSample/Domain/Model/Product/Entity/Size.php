<?php
namespace Packages\DDDEcSample\Domain\Model\Product\Entity;

use Packages\DDDEcSample\Domain\Model\Product\VO\{SizeId, SizeName};

/**
 * class Size
 * 
 */
class Size
{
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