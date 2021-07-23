<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductList;

use Illuminate\View\View;
use Packages\DDDEcSample\UseCase\Product\IProductRepository;
use Packages\DDDEcSample\UseCase\Product\ProductGroupUseCaseData;

/**
 * class ProductListUseCase
 * 
 */
class ProductListUseCase implements IProductListUseCase
{
  /** @var IProductListPresenter */
  private $_objProductListPresenter = null;
  /** @var IProductRepository */
  private $_objProductRepository = null;

  function __construct(IProductListPresenter $objProductListPresenter, IProductRepository $objProductRepository) {
    $this->_objProductListPresenter = $objProductListPresenter;
    $this->_objProductRepository = $objProductRepository;
  }
  /**
   * 
   *
   * @param InputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(ProductListInputData $inputData) : View {
    $_objProductGroupList = $this->_objProductRepository->findAll();
    $_objProductGroups = $_objProductGroupList->map(function ($_objProduct) {
      return new ProductGroupUseCaseData($_objProduct);
    });
    return $this->_objProductListPresenter->output(
      new ProductListOutputData($inputData, $_objProductGroups)
    );
  }
}