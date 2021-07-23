<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\VO;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class UpdDate
 * 
 */
class UpdDate extends StringValue implements Arrayable
{
  use ViewModelTrait;
  function __construct(string $updDate = "") {
    parent::__construct("" !== $updDate ? $updDate : date('Y-m-d H:i:s'), "updDate");
  }
}