<?php
namespace Packages\Common\UseCase\Common;

/**
 * interface ISessionRepository
 * 
 */
interface ISessionRepository
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function has(string $key) : bool;
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function get(string $key, $defaultValue = null);
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function put(string $key, $value);
/**
   * 
   *
   * @abstract
   * @access public
   */
  public function forget(string $key);
}