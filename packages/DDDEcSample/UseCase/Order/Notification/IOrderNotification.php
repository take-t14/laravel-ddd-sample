<?php
namespace Packages\DDDEcSample\UseCase\Order\Notification;

use Packages\DDDEcSample\UseCase\Order\OrderUseCaseData;

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
  public function notify(OrderUseCaseData $order);
}