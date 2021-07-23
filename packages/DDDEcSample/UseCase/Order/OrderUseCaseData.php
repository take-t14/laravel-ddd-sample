<?php
namespace Packages\DDDEcSample\UseCase\Order;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};
use Packages\DDDEcSample\Domain\Model\Order\Entity\Order;
use Illuminate\Support\Collection;

/**
 * class OrderUseCaseData
 * 
 */
class OrderUseCaseData implements Arrayable
{
  use ViewModelTrait;
  private $orderTableId = null;
  private $lastName = null;
  private $firstName = null;
  private $address = null;
  private $mail = null;
  private $tel = null;
  private $zip = null;
  private $insDate = null;
  private $total = null;
  private $totalTaxin = null;
  /** @var Collection */
  private $items = null;
  function __construct(Order $order) {
    $this->orderTableId = new IntegerViewData($order->getOrderTableId()->getValue());
    $this->lastName = new StringViewData($order->getLastName()->getValue());
    $this->firstName = new StringViewData($order->getFirstName()->getValue());
    $this->address = new StringViewData($order->getAddress()->getValue());
    $this->mail = new StringViewData($order->getMail()->getValue());
    $this->tel = new StringViewData($order->getTel()->getValue());
    $this->zip = new StringViewData($order->getZip()->getValue());
    $this->total = new IntegerViewData($order->getTotal()->getValue());
    $this->totalTaxin = new IntegerViewData($order->getTotalTaxin()->getValue());
    $this->insDate = new StringViewData($order->getInsDate()->getValue());
    $this->items = $order->getOrderItems()->map(function ($orderItem) {
      return new OrderItemUseCaseData($orderItem);
    });
  }
  public function getOrderTableId() : IntegerViewData {
    return $this->orderTableId;
  }
  public function getLastName() : StringViewData {
    return $this->lastName;
  }
  public function getFirstName() : StringViewData {
    return $this->firstName;
  }
  public function getAddress() : StringViewData {
    return $this->address;
  }
  public function getMail() : StringViewData {
    return $this->mail;
  }
  public function getTel() : StringViewData {
    return $this->tel;
  }
  public function getZip() : StringViewData {
    return $this->zip;
  }
  public function getTotal() : IntegerViewData {
    return $this->total;
  }
  public function getTotalTaxin() : IntegerViewData {
    return $this->totalTaxin;
  }
  public function getOrderItems() : Collection {
    return $this->items;
  }
}