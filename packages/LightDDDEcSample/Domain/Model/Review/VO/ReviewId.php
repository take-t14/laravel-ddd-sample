<?php
namespace Packages\LightDDDEcSample\Domain\Model\Review\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\PositiveNumber;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ReviewId
 * 
 */
class ReviewId extends PositiveNumber implements Arrayable
{
  use ViewModelTrait;
  function __construct(int $value) {
    parent::__construct($value, "reviewId");
  }
}