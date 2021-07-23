<?php
namespace Packages\DDDEcSample\UseCase\Order;

use Packages\DDDEcSample\Domain\Model\Order\Entity\Order;

/**
 * class IOrderRepository
 * 
 */
interface IOrderRepository
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function save(Order $order) : Order;
}