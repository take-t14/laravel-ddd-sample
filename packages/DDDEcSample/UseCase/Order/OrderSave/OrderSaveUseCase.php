<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderSave;

use Illuminate\Http\JsonResponse;
use Packages\DDDEcSample\UseCase\Cart\ICartRepository;
use Packages\DDDEcSample\UseCase\Order\IOrderRepository;
use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;
use Packages\DDDEcSample\Domain\Model\Order\VO\ValidateError;
use Packages\DDDEcSample\Domain\Model\Order\Entity\Order;
use Packages\DDDEcSample\UseCase\Common\ValidationUseCaseData;
use Packages\DDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\{ValidateException, ValidateExceptionCollection};
use Packages\DDDEcSample\Domain\Service\Cart\CartService;
use Packages\DDDEcSample\UseCase\Order\Notification\IOrderNotification;
use Packages\DDDEcSample\UseCase\Order\OrderUseCaseData;

/**
 * class OrderSaveUseCase
 * 
 */
class OrderSaveUseCase implements IOrderSaveUseCase
{
  /** @var IOrderSavePresenter */
  private $orderSavePresenter = null;
  /** @var ICartRepository */
  private $cartRepository = null;
  /** @var IOrderRepository */
  private $orderRepository = null;
  /** @var CartService */
  private $cartService = null;
  /** @var IOrderNotification */
  private $orderNotification = null;

  function __construct(IOrderSavePresenter $orderSavePresenter, ICartRepository $cartRepository
    , IOrderRepository $orderRepository, IOrderNotification $orderNotification, CartService $cartService) {
    $this->orderSavePresenter = $orderSavePresenter;
    $this->cartRepository = $cartRepository;
    $this->orderRepository = $orderRepository;
    $this->orderNotification = $orderNotification;
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
  public function handle(OrderSaveInputData $inputData) : JsonResponse {
    return \DB::transaction(function() use($inputData) {
      /** @var Cart */
      $cart = $this->cartRepository->find();
      /** @var ValidateError $validateError */
      $validateError = $this->cartService->validateCart($cart);
      if (isset($cart)) {
        $order = null;
        try {
            $order = Order::createOrder(null, $inputData->getLastName(), $inputData->getFirstName(), $inputData->getAddress1()
              , $inputData->getMail(), $inputData->getTel(), $inputData->getZip(), $cart);
            $order = $this->orderRepository->save($order);
            $this->orderNotification->notify(new OrderUseCaseData($order));
        } catch (ValidateExceptionCollection $err) {
          $validateError = $validateError->addErrorsByExCollection($err);
        }
      }
      return $this->orderSavePresenter->output(
        new OrderSaveOutputData($inputData
          , new ValidationUseCaseData($validateError)
          , $cart)
      );
    });
  }
}