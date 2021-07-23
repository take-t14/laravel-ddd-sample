<?php
namespace Packages\LightDDDEcSample\UseCase\Order;

use Packages\LightDDDEcSample\Domain\Model\Order\Entity\Order;

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