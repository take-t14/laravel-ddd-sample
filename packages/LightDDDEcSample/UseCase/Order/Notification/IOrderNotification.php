<?php
namespace Packages\LightDDDEcSample\UseCase\Order\Notification;

use Packages\LightDDDEcSample\Domain\Model\Order\Entity\Order;

/**
 * class IOrderNotification
 * 
 */
interface IOrderNotification
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function notify(Order $order);
}