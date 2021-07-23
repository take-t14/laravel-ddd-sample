<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderSave;

/**
 * class OrderSaveInputData
 * 
 */
class OrderSaveInputData
{
  private $lastName = "";
  private $firstName = "";
  private $mail = "";
  private $tel = "";
  private $zip = "";
  private $address1 = "";
  function __construct(string $lastName, string $firstName, string $mail, string $tel, string $zip, string $address1) {
    $this->lastName = $lastName;
    $this->firstName = $firstName;
    $this->mail = $mail;
    $this->tel = $tel;
    $this->zip = $zip;
    $this->address1 = $address1;
  }
  public function getLastName() : string {
    return $this->lastName;
  }
  public function getFirstName() : string {
    return $this->firstName;
  }
  public function getMail() : string {
    return $this->mail;
  }
  public function getTel() : string {
    return $this->tel;
  }
  public function getZip() : string {
    return $this->zip;
  }
  public function getAddress1() : string {
    return $this->address1;
  }
}