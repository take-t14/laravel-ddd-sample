<?php
namespace Packages\LightDDDEcSample\Domain\Model\Product\Entity;

use Packages\LightDDDEcSample\Domain\Model\Product\VO\{ColorId, ColorName};
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class Color
 * 
 */
class Color implements Arrayable
{
  use ViewModelTrait;
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