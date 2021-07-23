<?php
namespace Packages\LightDDDEcSample\UseCase\Template;

//use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection as Collection;

/**
 * class IRepository
 * 
 */
interface IRepository
{
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findAll() : Collection;
}