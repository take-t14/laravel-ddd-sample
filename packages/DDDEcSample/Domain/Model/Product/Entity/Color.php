<?php
namespace Packages\DDDEcSample\Domain\Model\Product\Entity;

use Packages\DDDEcSample\Domain\Model\Product\VO\{ColorId, ColorName};

/**
 * class Color
 * 
 */
class Color
{
  /** @var ColorId */
  private $colorId = null;
  /** @var ColorName */
  private $colorName = null;
  function __construct(ColorId $colorId, ColorName $colorName) {
    $this->colorId = $colorId;
    $this->colorName = $colorName;
  }
  public function getColorId() : ColorId {
    return $this->colorId;
  }
  public function getColorName() : ColorName {
    return $this->colorName;
  }
}