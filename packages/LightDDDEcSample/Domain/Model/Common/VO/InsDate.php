<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\VO;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class InsDate
 * 
 */
class InsDate extends StringValue implements Arrayable
{
  use ViewModelTrait;
  function __construct(string $insDate = "") {
    parent::__construct("" !== $insDate ? $insDate : date('Y-m-d H:i:s'), "insDate");
  }
}