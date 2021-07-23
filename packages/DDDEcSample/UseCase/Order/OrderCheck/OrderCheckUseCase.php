<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderCheck;

use Illuminate\Http\JsonResponse;
use Packages\DDDEcSample\UseCase\Cart\ICartRepository;
use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;
use Packages\DDDEcSample\Domain\Model\Order\VO\ValidateError;
use Packages\DDDEcSample\Domain\Service\Cart\CartService;
use Packages\DDDEcSample\Domain\Model\Order\Entity\Order;
use Packages\DDDEcSample\UseCase\Common\ValidationUseCaseData;
use Packages\DDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\{ValidateException, ValidateExceptionCollection};

/**
 * class OrderCheckUseCase
 * 
 */
class OrderCheckUseCase implements IOrderCheckUseCase
{
  /** @var IOrderCheckPresenter */
  private $orderCheckPresenter = null;
  /** @var ICartRepository */
  private $cartRepository = null;
  /** @var CartService */
  private $cartService = null;

  function __construct(IOrderCheckPresenter $orderCheckPresenter, ICartRepository $cartRepository
    , CartService $cartService) {
    $this->orderCheckPresenter = $orderCheckPresenter;
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
  public function handle(OrderCheckInputData $inputData) : JsonResponse {
    /** @var Cart */
    $cart = $this->cartRepository->find();
    /** @var ValidateError $validateError */
    $validateError = $this->cartService->validateCart($cart);
    if (isset($cart)) {
      try {
        $order = Order::createOrder(null, $inputData->getLastName(), $inputData->getFirstName(), $inputData->getAddress1()
          , $inputData->getMail(), $inputData->getTel(), $inputData->getZip(), $cart);
      } catch (ValidateExceptionCollection $err) {
        $validateError = $validateError->addErrorsByExCollection($err);
      }
    }
    return $this->orderCheckPresenter->output(
      new OrderCheckOutputData($inputData
        , new ValidationUseCaseData($validateError)
        , $cart)
    );
  }
}