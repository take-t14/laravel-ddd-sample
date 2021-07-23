<?php
namespace Packages\DDDEcSample\Infrastructure\Order\Notification\Mail;

use Packages\DDDEcSample\UseCase\Order\Notification\IOrderNotification;
use Packages\DDDEcSample\UseCase\Order\OrderUseCaseData;
use Packages\DDDEcSample\Infrastructure\Common\Notification\Mail\ContactMail;
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
  public function notify(OrderUseCaseData $order) {
    $contactMail = new ContactMail(
        ["hatake.t14@gmail.com"]
      , "【XXXXショップ】ご注文ありがとうございます"
      , "mail.order.order"
      , ["order" => $order->toArray()]
    );
    Mail::to($order->getMail()->getValue())
      ->send($contactMail);
  }
}