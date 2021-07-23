<?php
namespace Packages\LightDDDEcSample\UseCase\Cart;

use Packages\LightDDDEcSample\Domain\Model\Cart\Entity\Cart;

/**
 * class ICartRepository
 * 
 */
interface ICartRepository
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function find() : ?Cart;
  public function newEmptyCart() : Cart;
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function save(Cart $cart);
}