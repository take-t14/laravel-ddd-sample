<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product;

use Packages\DDDEcSample\UseCase\Product\SizeUseCaseData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};

/**
 * class SizeViewData
 * 
 */
class SizeViewData implements Arrayable
{
  use ViewModelTrait;
  private $sizeId = null;
  private $sizeName = null;
  function __construct(SizeUseCaseData $size) {
    $this->sizeId = new IntegerViewData($size->getSizeId()->getValue());
    $this->sizeName = new StringViewData($size->getSizeName()->getValue());
  }
  public function getSizeId() : IntegerViewData {
    return $this->sizeId;
  }
  public function getSizeName() : StringViewData {
    return $this->sizeName;
  }
}