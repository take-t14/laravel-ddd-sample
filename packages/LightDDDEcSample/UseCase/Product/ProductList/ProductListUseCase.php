<?php
namespace Packages\LightDDDEcSample\UseCase\Product\ProductList;

use Illuminate\View\View;
use Packages\LightDDDEcSample\UseCase\Product\IProductRepository;
use Packages\LightDDDEcSample\UseCase\Common\Presenters\IViewPresenter;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;

/**
 * class IProductListUseCase
 * 
 */
class ProductListUseCase implements IProductListUseCase
{
  /** @var IViewPresenter */
  private $viewPresenter = null;
  /** @var IProductRepository */
  private $_objProductRepository = null;

  function __construct(IViewPresenter $viewPresenter, IProductRepository $objProductRepository) {
    $this->viewPresenter = $viewPresenter;
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
  public function handle(InputData $inputData) : View {
    $viewModel = ["productGroups" => $this->_objProductRepository->findAll()];
    return $this->viewPresenter->output(
      new OutputData($inputData, compact("viewModel"))
    );
  }
}