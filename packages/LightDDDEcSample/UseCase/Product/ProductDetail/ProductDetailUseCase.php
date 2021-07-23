<?php
namespace Packages\LightDDDEcSample\UseCase\Product\ProductDetail;

use Illuminate\View\View;
use Packages\LightDDDEcSample\Domain\Model\Product\VO\ProductGroupId;
use Packages\LightDDDEcSample\UseCase\Product\{IProductRepository};
use Packages\LightDDDEcSample\UseCase\Review\{IReviewRepository};
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;
use Packages\LightDDDEcSample\UseCase\Common\Presenters\IViewPresenter;

/**
 * class ProductDetailUseCase
 * 
 */
class ProductDetailUseCase implements IProductDetailUseCase
{
  /** @var IViewPresenter */
  private $viewPresenter = null;
  /** @var IProductRepository */
  private $productRepository = null;
  /** @var IReviewRepository */
  private $reviewRepository = null;

  function __construct(IViewPresenter $viewPresenter
    , IProductRepository $objProductRepository, IReviewRepository $objReviewRepository) {
    $this->viewPresenter = $viewPresenter;
    $this->productRepository = $objProductRepository;
    $this->reviewRepository = $objReviewRepository;
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
    $productGroupId = new ProductGroupId((int)$inputData->getValue("productGroupId"));
    $viewModel = [
        "productGroup" => $this->productRepository->findByGroupId($productGroupId)
      , "reviews" => $this->reviewRepository->findByProductGroupId($productGroupId)
    ];
    return $this->viewPresenter->output(
      new OutputData($inputData, compact("viewModel"))
    );
  }
}