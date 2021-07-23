<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductDetail;

//use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection as Collection;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductGroupViewData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class ProductDetailViewModel
 * 
 */
class ProductDetailViewModel implements Arrayable
{
  use ViewModelTrait;
  private $productGroup = null;
  private $reviews = null;
  function __construct(ProductGroupViewData $productGroup, Collection $reviews) {
    $this->productGroup = $productGroup;
    $this->reviews = $reviews;
  }
  public function getProductGroup() : ProductGroupViewData {
    return $this->productGroup;
  }
  public function getReviews() : Collection {
    return $this->reviews;
  }
}