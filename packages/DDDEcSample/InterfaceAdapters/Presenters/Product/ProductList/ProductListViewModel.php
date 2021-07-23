<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductList;

use Illuminate\Support\Collection;
//use Illuminate\Support\LazyCollection as Collection;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ProductListViewModel
 * 
 */
class ProductListViewModel implements Arrayable
{
  use ViewModelTrait;
  private $productGroups = null;
  function __construct(Collection $productGroups) {
    $this->productGroups = $productGroups;
  }
  public function getProductGroups() : Collection {
    return $this->productGroups;
  }
}