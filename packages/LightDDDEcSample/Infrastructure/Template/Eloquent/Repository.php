<?php
namespace Packages\LightDDDEcSample\Infrastructure\Template\Eloquent;

use Packages\LightDDDEcSample\UseCase\Template\IRepository;
//use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection as Collection;

/**
 * class Repository
 * 
 */
class Repository implements IRepository
{
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findAll() : Collection {
    
  }
}