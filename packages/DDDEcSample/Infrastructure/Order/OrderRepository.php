<?php
namespace Packages\DDDEcSample\Infrastructure\Order\Eloquent;

use Packages\DDDEcSample\Domain\Model\Order\Entity\{Order, OrderItem};
use Packages\DDDEcSample\Domain\Model\Order\VO\{OrderTableId};
use Packages\DDDEcSample\UseCase\Order\IOrderRepository;

/**
 * class OrderRepository
 * 
 */
class OrderRepository implements IOrderRepository
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function save(Order $order) : Order {
    $orderTableId = new OrderTableId($this->nextVal());
    $tmpOrder = new Order($orderTableId, $order->getLastName(), $order->getFirstName(), $order->getAddress()
      , $order->getMail(), $order->getTel(), $order->getZip(), $order->getInsDate());
    \DB::table("test_schema.order_table")->insert([
        "order_table_id" => $orderTableId->getValue()
      , "total" => $order->getOrderTotal()->getValue()
      , "total_taxin" => $order->getOrderTotalTaxin()->getValue()
      , "first_name" => $order->getFirstName()->getValue()
      , "last_name" => $order->getLastName()->getValue()
      , "mail" => $order->getMail()->getValue()
      , "tel" => $order->getTel()->getValue()
      , "zip" => $order->getZip()->getValue()
      , "address1" => $order->getAddress()->getValue()
      , "ins_date" => $order->getInsDate()->getValue()
    ]);
    foreach($order->getOrderItems() as $orderItem) {
      /** @var OrderItem $orderItem */
      $tmpOrder->addOrderItem(
        new OrderItem($orderTableId, $orderItem->getProduct(), $orderItem->getQuantity(), $orderItem->getTaxRate(), $orderItem->getPrice())
      );
      \DB::table("test_schema.order_item")->insert([
         "order_table_id" => $orderTableId->getValue()
       , "product_id" => $orderItem->getProduct()->getProductId()->getValue()
       , "quantity" => $orderItem->getQuantity()->getValue()
       , "tax_rate" => $orderItem->getTaxRate()->getValue()
       , "price" => $orderItem->getPrice()->getValue()
       , "price_total" => $orderItem->getPriceTotal()->getValue()
       , "price_taxin" => $orderItem->getPriceTaxIn()->getValue()
       , "price_total_taxin" => $orderItem->getPriceTotalTaxin()->getValue()
     ]);
    }
    \SessionRepository::forget('dddCartId');
    return $tmpOrder;
  }
  private function nextVal() : int {
    $result = \DB::selectOne("SELECT nextval('test_schema.order_table_order_table_id_seq') as nextval");
    return $result->nextval;
  }
}