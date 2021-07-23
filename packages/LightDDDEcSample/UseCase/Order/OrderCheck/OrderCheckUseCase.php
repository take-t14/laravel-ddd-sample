<?php
namespace Packages\LightDDDEcSample\UseCase\Order\OrderCheck;

use Illuminate\Http\JsonResponse;
use Packages\LightDDDEcSample\UseCase\Cart\ICartRepository;
use Packages\LightDDDEcSample\Domain\Model\Cart\Entity\Cart;
use Packages\LightDDDEcSample\Domain\Model\Order\VO\ValidateError;
use Packages\LightDDDEcSample\Domain\Service\Cart\CartService;
use Packages\LightDDDEcSample\Domain\Model\Order\Entity\Order;
use Packages\LightDDDEcSample\UseCase\Common\ValidationUseCaseData;
use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\{ValidateException, ValidateExceptionCollection};
use Packages\LightDDDEcSample\UseCase\Common\Presenters\IApiPresenter;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;

/**
 * class OrderCheckUseCase
 * 
 */
class OrderCheckUseCase implements IOrderCheckUseCase
{
  /** @var IApiPresenter */
  private $apiPresenter = null;
  /** @var ICartRepository */
  private $cartRepository = null;
  /** @var CartService */
  private $cartService = null;

  function __construct(IApiPresenter $apiPresenter, ICartRepository $cartRepository
    , CartService $cartService) {
    $this->apiPresenter = $apiPresenter;
    $this->cartRepository = $cartRepository;
    $this->cartService = $cartService;
  }
  /**
   * 
   *
   * @param InputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(InputData $inputData) : JsonResponse {
    /** @var Cart */
    $cart = $this->cartRepository->find();
    /** @var ValidateError $validateError */
    $validateError = $this->cartService->validateCart($cart);
    if (isset($cart)) {
      try {
        $order = Order::createOrder(null, $inputData->getValue("lastName")
        , $inputData->getValue("firstName"), $inputData->getValue("address1")
          , $inputData->getValue("mail"), $inputData->getValue("tel"), $inputData->getValue("zip"), $cart);
      } catch (ValidateExceptionCollection $err) {
        $validateError = $validateError->addErrorsByExCollection($err);
      }
    }
    return $this->apiPresenter->output(
      new OutputData($inputData, [
        "validationViewData" => new ValidationUseCaseData($validateError)
        , "cart" => $cart
      ])
    );
  }
}