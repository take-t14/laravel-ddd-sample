<?php
namespace Packages\DDDEcSample\UseCase\Cart;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;

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