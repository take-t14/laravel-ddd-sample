<?php
namespace Packages\DDDEcSample\UseCase\Product;

use Packages\DDDEcSample\Domain\Model\Product\Entity\Color;
use Packages\DDDEcSample\UseCase\Common\{IntegerUseCaseData, StringUseCaseData};

/**
 * class ColorUseCaseData
 * 
 */
class ColorUseCaseData
{
  private $colorId = null;
  private $colorName = null;
  function __construct(Color $color) {
    $this->colorId = new IntegerUseCaseData($color->getColorId()->getValue());
    $this->colorName = new StringUseCaseData($color->getColorName()->getValue());
  }
  public function getColorId() : IntegerUseCaseData {
    return $this->colorId;
  }
  public function getColorName() : StringUseCaseData {
    return $this->colorName;
  }
}