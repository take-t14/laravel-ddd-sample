<?php
namespace Packages\DDDEcSample\UseCase\Product;

use Packages\DDDEcSample\Domain\Model\Product\Entity\Size;
use Packages\DDDEcSample\UseCase\Common\{IntegerUseCaseData, StringUseCaseData};

/**
 * class SizeUseCaseData
 * 
 */
class SizeUseCaseData
{
  private $sizeId = null;
  private $sizeName = null;
  function __construct(Size $size) {
    $this->sizeId = new IntegerUseCaseData($size->getSizeId()->getValue());
    $this->sizeName = new StringUseCaseData($size->getSizeName()->getValue());
  }
  public function getSizeId() : IntegerUseCaseData {
    return $this->sizeId;
  }
  public function getSizeName() : StringUseCaseData {
    return $this->sizeName;
  }
}