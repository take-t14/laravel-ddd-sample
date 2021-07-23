<?php
namespace Packages\Common\Infrastructure\Session\Memory;

use Packages\Common\UseCase\Common\ISessionRepository;

/**
 * class SessionRepository
 * 
 */
class SessionRepository implements ISessionRepository
{
  private $session = [];
  function __construct() {
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function has(string $key) : bool {
    return isset($this->session[$key]);
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function get(string $key, $defaultValue = null) {
    return isset($this->session[$key]) ? $this->session[$key] : $defaultValue;
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function put(string $key, $value) {
    $this->session[$key] = $value;
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function forget(string $key) {
    unset($this->session[$key]);
  }
}