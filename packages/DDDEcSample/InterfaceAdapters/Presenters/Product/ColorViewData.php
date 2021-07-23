<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product;

use Packages\DDDEcSample\UseCase\Product\ColorUseCaseData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};

/**
 * class ColorViewData
 * 
 */
class ColorViewData implements Arrayable
{
  use ViewModelTrait;
  private $colorId = null;
  private $colorName = null;
  function __construct(ColorUseCaseData $color) {
    $this->colorId = new IntegerViewData($color->getColorId()->getValue());
    $this->colorName = new StringViewData($color->getColorName()->getValue());
  }
  public function getColorId() : IntegerViewData {
    return $this->colorId;
  }
  public function getColorName() : StringViewData {
    return $this->colorName;
  }
}