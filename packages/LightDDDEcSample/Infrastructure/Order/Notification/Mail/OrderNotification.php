<?php
namespace Packages\LightDDDEcSample\Infrastructure\Order\Notification\Mail;

use Packages\LightDDDEcSample\UseCase\Order\Notification\IOrderNotification;
use Packages\LightDDDEcSample\Domain\Model\Order\Entity\Order;
use Packages\LightDDDEcSample\Infrastructure\Common\Notification\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

/**
 * class OrderNotification
 * 
 */
class OrderNotification implements IOrderNotification
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function notify(Order $order) {
    $contactMail = new ContactMail(
        ["xxxshop@take14.shop"]
      , "【XXXXショップ】ご注文ありがとうございます"
      , "mail.order.order"
      , ["order" => $order->toArray()]
    );
    Mail::to($order->getMail()->getValue())
      ->send($contactMail);
  }
}
