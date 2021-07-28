<?php

namespace Packages\MvcSample\App\Libs\Mail;

use Illuminate\Support\Facades\Mail;

/**
 * class OrderNotification
 * 
 */
class OrderNotification
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function notify(array $order) {
    $contactMail = new ContactMail(
        ["xxxshop@take14.shop"]
      , "【XXXXショップ】ご注文ありがとうございます"
      , "mail.order.order"
      , ["order" => $order]
    );
    Mail::to($order["mail"]["value"])
      ->send($contactMail);
  }
}
