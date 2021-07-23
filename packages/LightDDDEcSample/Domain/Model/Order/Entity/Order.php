<?php
namespace Packages\LightDDDEcSample\Domain\Model\Order\Entity;

use Packages\LightDDDEcSample\Domain\Model\Order\VO\{OrderTableId, Address, Mail, FirstName, LastName, Tel, Zip};
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\{Quantity, TaxRate, Total, TotalTaxin};
use Packages\LightDDDEcSample\Domain\Model\Common\VO\InsDate;
use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\{ValidateException, ValidateExceptionCollection};
use Illuminate\Support\Collection;
use Packages\LightDDDEcSample\Domain\Model\Cart\Entity\{Cart, CartItem};
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\OrderBase;
use Packages\LightDDDEcSample\Domain\Service\Common\{ModelFactory, ModelFactoryItem};
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class Order
 * 
 */
class Order extends OrderBase implements Arrayable
{
  use ViewModelTrait;
  /** @var OrderTableId */
  private $orderTableId = null;
  /** @var LastName */
  private $lastName = null;
  /** @var FirstName */
  private $firstName = null;
  /** @var Address */
  private $address = null;
  /** @var Mail */
  private $mail = null;
  /** @var Tel */
  private $tel = null;
  /** @var Zip */
  private $zip = null;
  /** @var InsDate */
  private $insDate = null;
  function __construct(?OrderTableId $orderTableId, LastName $lastName, FirstName $firstName
    , Address $address, Mail $mail, Tel $tel, Zip $zip, ?InsDate $insDate = null) {
    parent::__construct();
    $this->orderTableId = $orderTableId;
    $this->lastName = $lastName;
    $this->firstName = $firstName;
    $this->address = $address;
    $this->mail = $mail;
    $this->tel = $tel;
    $this->zip = $zip;
    $this->insDate = !is_null($insDate) ? $insDate : new InsDate();
  }
  public function getOrderTableId() : OrderTableId {
    return $this->orderTableId;
  }
  public function getLastName() : LastName {
    return $this->lastName;
  }
  public function getFirstName() : FirstName {
    return $this->firstName;
  }
  public function getAddress() : Address {
    return $this->address;
  }
  public function getMail() : Mail {
    return $this->mail;
  }
  public function getTel() : Tel {
    return $this->tel;
  }
  public function getZip() : Zip {
    return $this->zip;
  }
  public function getInsDate() : InsDate {
    return $this->insDate;
  }
  public function getOrderItems() : Collection {
    return $this->getItems();
  }
  public function getOrderTotal() : Total {
    return $this->getTotal();
  }
  public function getOrderTotalTaxin() : TotalTaxin {
    return $this->getTotalTaxin();
  }
  public function addOrderItemByCart(Cart $cart) {
    foreach($cart->getCartItems() as $cartItem) {
      /** @var CartItem $cartItem */
      $this->addOrderItem(
        new OrderItem($this->orderTableId
          , $cartItem->getProduct()
          , new Quantity($cartItem->getQuantity()->getValue())
          , new TaxRate(10), $cartItem->getProduct()->getPrice()
      ));
    }
    $this->calc();
  }
  public function addOrderItem(OrderItem $orderItem) {
    $this->items->push($orderItem);
    $this->calc();
  }
  static public function createOrder(?int $orderTableId, string $lastName, string $firstName
    , string $address, string $mail, string $tel, string $zip, Cart $cart) : Order {
    $modelItems = [
        new ModelFactoryItem(LastName::class, ["lastName" => $lastName])
      , new ModelFactoryItem(FirstName::class, ["firstName" => $firstName])
      , new ModelFactoryItem(Address::class, ["value" => $address])
      , new ModelFactoryItem(Mail::class, ["mail" => $mail])
      , new ModelFactoryItem(Tel::class, ["tel" => $tel])
      , new ModelFactoryItem(Zip::class, ["zip" => $zip])
    ];
    if (!is_null($orderTableId)) {
      $modelItems[] = new ModelFactoryItem(OrderTableId::class, ["value" => $orderTableId]);
    }
    $modelFactory = new ModelFactory($modelItems);
    $order = new Order(
      $modelFactory->getModelInstance(OrderTableId::class)
      , $modelFactory->getModelInstance(LastName::class)
      , $modelFactory->getModelInstance(FirstName::class)
      , $modelFactory->getModelInstance(Address::class)
      , $modelFactory->getModelInstance(Mail::class)
      , $modelFactory->getModelInstance(Tel::class)
      , $modelFactory->getModelInstance(Zip::class));
    $order->addOrderItemByCart($cart);
    
    return $order;
  }
}