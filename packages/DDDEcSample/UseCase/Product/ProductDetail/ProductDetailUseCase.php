<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductDetail;

use Illuminate\View\View;
use Packages\DDDEcSample\Domain\Model\Product\VO\ProductGroupId;
use Packages\DDDEcSample\UseCase\Product\IProductRepository;
use Packages\DDDEcSample\UseCase\Review\IReviewRepository;
use Packages\DDDEcSample\UseCase\Product\ProductGroupUseCaseData;
use Packages\DDDEcSample\UseCase\Review\ReviewUseCaseData;
use Packages\DDDEcSample\Domain\Model\Product\VO\ProductId;

/**
 * class ProductDetailUseCase
 * 
 */
class ProductDetailUseCase implements IProductDetailUseCase
{
  /** @var IProductDetailPresenter */
  private $productDetailPresenter = null;
  /** @var IProductRepository */
  private $productRepository = null;
  /** @var IReviewRepository */
  private $reviewRepository = null;

  function __construct(IProductDetailPresenter $objProductDetailPresenter
    , IProductRepository $objProductRepository, IReviewRepository $objReviewRepository) {
    $this->productDetailPresenter = $objProductDetailPresenter;
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
  public function handle(ProductDetailInputData $inputData) : View {
    $productGroupId = new ProductGroupId((int)$inputData->getProductGroupId());
    $productGroup = $this->productRepository->findByGroupId($productGroupId);
    $reviews = $this->reviewRepository->findByProductGroupId($productGroupId);
    $reviews = $reviews->map(function ($review) {
      return new ReviewUseCaseData($review);
    });
    return $this->productDetailPresenter->output(
      new ProductDetailOutputData($inputData
      , new ProductGroupUseCaseData($productGroup)
      , $reviews
    ));
  }
}