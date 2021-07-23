<?php
namespace Packages\LightDDDEcSample\UseCase\Cart\CartShow;

use Illuminate\View\View;
use Packages\LightDDDEcSample\UseCase\Cart\ICartRepository;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;
use Packages\LightDDDEcSample\UseCase\Common\Presenters\IViewPresenter;

/**
 * class CartShowUseCase
 * 
 */
class CartShowUseCase implements ICartShowUseCase
{
  /** @var IViewPresenter */
  private $viewPresenter = null;
  /** @var ICartRepository */
  private $cartRepository = null;

  function __construct(IViewPresenter $viewPresenter, ICartRepository $cartRepository) {
    $this->viewPresenter = $viewPresenter;
    $this->cartRepository = $cartRepository;
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
    $viewModel = ["cart" => $this->cartRepository->find()];
    return $this->viewPresenter->output(
      new OutputData($inputData, compact("viewModel"))
    );
  }
}