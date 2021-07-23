<?php

namespace Tests\Unit\LightDDDEcSample;

use Packages\LightDDDEcSample\UseCase\Cart\CartShow\ICartShowUseCase;
use Packages\LightDDDEcSample\UseCase\Cart\CartAdd\ICartAddUseCase;
use Packages\LightDDDEcSample\UseCase\Order\OrderForm\IOrderFormUseCase;
use Packages\LightDDDEcSample\UseCase\Order\OrderCheck\IOrderCheckUseCase;
use Packages\LightDDDEcSample\UseCase\Order\OrderSave\IOrderSaveUseCase;
use Packages\LightDDDEcSample\UseCase\Common\InputData\{InputData, IntInputData, BoolInputData, StringInputData};
use Tests\Unit\DDDEcSample\CartTest as DDDCartTest;
use Packages\LightDDDEcSample\UseCase\Order\OrderSave\OrderSaveUseCase;

class CartTest extends DDDCartTest
{
    function addCart() {
        /** @var ICartAddUseCase $cartAddUseCase */
        $cartAddUseCase = resolve(ICartAddUseCase::class);
        $jsonResponse = $cartAddUseCase->handle(new InputData([
            "productId" => new IntInputData("1")
          , "quantity" => new IntInputData("3")
          , "isRemove" => new BoolInputData("")
          , "isAllRemove" => new BoolInputData("")
        ]));
        $this->checkAddCartJson($jsonResponse->original["viewModel"]);
    }
    function showCart() {
        $_obICartShowUseCase = resolve(ICartShowUseCase::class);
        $view = $_obICartShowUseCase->handle(new InputData([], "cart.show.show"));
        $this->checkShowCartViewModel($view);
    }
    function orderForm() {
        $_obIOrderFormUseCase = resolve(IOrderFormUseCase::class);
        $view = $_obIOrderFormUseCase->handle(new InputData([], "order.form.form"));
        $this->checkOrderFormViewModel($view);
    }
    function orderCheck() {
        $orderCheckUseCase = resolve(IOrderCheckUseCase::class);
        $this->orderCheckFunc($orderCheckUseCase, InputData::class);
    }
    function orderCheckFunc($usecase, string $inputDataClassName) {
        $view = $usecase->handle(new $inputDataClassName([
            "lastName" => new StringInputData("手酢戸"), "firstName" => new StringInputData("太郎")
            , "mail" => new StringInputData("hatake.t14@gmail.com")
            , "tel" => new StringInputData("090-1111-2222")
            , "zip" => new StringInputData("100-0001")
            , "address1" => new StringInputData("東京都テスト区1-1-1")
        ]));
        $this->checkValidationData($view->original, []);
        if (is_a($usecase, OrderSaveUseCase::class)) $this->addCart();
        $view = $usecase->handle(new $inputDataClassName([
            "lastName" => new StringInputData(""), "firstName" => new StringInputData("太郎")
            , "mail" => new StringInputData("test@gmail.com")
            , "tel" => new StringInputData("090-1111-2222")
            , "zip" => new StringInputData("100-0001")
            , "address1" => new StringInputData("東京都テスト区1-1-1")
        ]));
        $this->checkValidationData($view->original, ["last_name"]);
        $view = $usecase->handle(new $inputDataClassName([
            "lastName" => new StringInputData(""), "firstName" => new StringInputData("")
            , "mail" => new StringInputData("test@gmail.com")
            , "tel" => new StringInputData("090-1111-2222")
            , "zip" => new StringInputData("100-0001")
            , "address1" => new StringInputData("東京都テスト区1-1-1")
        ]));
        $this->checkValidationData($view->original, ["last_name", "first_name"]);
        $view = $usecase->handle(new $inputDataClassName([
            "lastName" => new StringInputData(""), "firstName" => new StringInputData("")
            , "mail" => new StringInputData("test@gmail.comm")
            , "tel" => new StringInputData("090-1111-2222")
            , "zip" => new StringInputData("100-0001")
            , "address1" => new StringInputData("東京都テスト区1-1-1")
        ]));
        $this->checkValidationData($view->original, ["last_name", "first_name", "mail"]);
        $view = $usecase->handle(new $inputDataClassName([
            "lastName" => new StringInputData(""), "firstName" => new StringInputData("")
            , "mail" => new StringInputData("te@st@gmail.com")
            , "tel" => new StringInputData("090-1111-22222")
            , "zip" => new StringInputData("100-0001")
            , "address1" => new StringInputData("東京都テスト区1-1-1")
        ]));
        $this->checkValidationData($view->original, ["last_name", "first_name", "mail", "tel"]);
        $view = $usecase->handle(new $inputDataClassName([
            "lastName" => new StringInputData(""), "firstName" => new StringInputData("")
            , "mail" => new StringInputData("testgmail.com")
            , "tel" => new StringInputData("090-1111-2222-")
            , "zip" => new StringInputData("")
            , "address1" => new StringInputData("東京都テスト区1-1-1")
        ]));
        $this->checkValidationData($view->original, ["last_name", "first_name", "mail", "tel", "zip"]);
        $view = $usecase->handle(new $inputDataClassName([
            "lastName" => new StringInputData(""), "firstName" => new StringInputData("")
            , "mail" => new StringInputData("")
            , "tel" => new StringInputData("")
            , "zip" => new StringInputData("100-00011")
            , "address1" => new StringInputData("")
        ]));
        $this->checkValidationData($view->original, ["last_name", "first_name", "mail", "tel", "zip", "address1"]);
    }
    function orderSave() {
        $orderSaveUseCase = resolve(IOrderSaveUseCase::class);
        $this->orderCheckFunc($orderSaveUseCase, InputData::class);
        $this->checkOrderSave();
    }
}
