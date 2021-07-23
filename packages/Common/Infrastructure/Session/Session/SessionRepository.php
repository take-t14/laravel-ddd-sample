<?php
namespace Packages\Common\Infrastructure\Session\Session;

use Packages\Common\UseCase\Common\ISessionRepository;

/**
 * class SessionRepository
 * 
 */
class SessionRepository implements ISessionRepository
{
  private $session = null;
  function __construct() {
    $this->session = session();
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function has(string $key) : bool {
    return $this->session->has($key);
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function get(string $key, $defaultValue = null) {
    return $this->session->get($key, $defaultValue);
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function put(string $key, $value) {
    $this->session->put($key, $value);
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function forget(string $key) {
    $this->session->forget($key);
  }
}