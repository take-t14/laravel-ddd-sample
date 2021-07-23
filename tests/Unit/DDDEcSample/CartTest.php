<?php

namespace Tests\Unit\DDDEcSample;

use Tests\TestCase;
use Packages\DDDEcSample\UseCase\Cart\CartShow\ICartShowUseCase;
use Packages\DDDEcSample\UseCase\Cart\CartShow\CartShowInputData;
use Packages\DDDEcSample\UseCase\Cart\CartAdd\ICartAddUseCase;
use Packages\DDDEcSample\UseCase\Cart\CartAdd\CartAddInputData;
use Packages\DDDEcSample\UseCase\Order\OrderForm\IOrderFormUseCase;
use Packages\DDDEcSample\UseCase\Order\OrderForm\OrderFormInputData;
use Packages\DDDEcSample\UseCase\Order\OrderCheck\IOrderCheckUseCase;
use Packages\DDDEcSample\UseCase\Order\OrderCheck\OrderCheckInputData;
use Packages\DDDEcSample\UseCase\Order\OrderSave\IOrderSaveUseCase;
use Packages\DDDEcSample\UseCase\Order\OrderSave\OrderSaveInputData;
use Packages\DDDEcSample\Presentation\Cart\CartViewData;
use stdClass;

class CartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCartUseCase()
    {
        app()->singleton(\Packages\Common\UseCase\Common\ISessionRepository::class
            , \Packages\Common\Infrastructure\Session\Memory\SessionRepository::class);
        $this->addCart();
        $this->showCart();
        $this->orderForm();
        $this->orderCheck();
        $this->orderSave();
    }

    function addCart() {
        /** @var ICartAddUseCase $cartAddUseCase */
        $cartAddUseCase = resolve(ICartAddUseCase::class);
        $jsonResponse = $cartAddUseCase->handle(new CartAddInputData("1", "3", "", ""));
        $this->checkAddCartJson($jsonResponse->original["viewModel"]);
    }
    protected function checkAddCartJson(array $viewModel) {
        $this->assertTrue(!is_null($viewModel));
        $this->assertTrue(!is_null($viewModel));
        $this->assertTrue(is_array($viewModel));
        $this->assertTrue(!is_null($viewModel["cart"]["cartId"]["value"]));
        $this->assertTrue(!is_null($viewModel["cart"]["items"]));
        $this->assertTrue(is_array($viewModel["cart"]["items"]));
        $this->assertTrue(1 === count($viewModel["cart"]["items"]));
        foreach($viewModel["cart"]["items"] as $cartItem) {
            $this->assertTrue(is_array($cartItem));
            $this->assertTrue(!is_null($cartItem["cartId"]["value"]));
            $this->assertTrue(!is_null($cartItem["quantity"]["value"]));
            $this->assertTrue(3 === $cartItem["quantity"]["value"]);
            $this->assertTrue(!is_null($cartItem["product"]));
            $this->assertTrue(is_array($cartItem["product"]));
            $this->assertTrue(!is_null($cartItem["product"]["productId"]["value"]));
            $this->assertTrue(1 === $cartItem["product"]["productId"]["value"]);
            $this->assertTrue(!is_null($cartItem["product"]["productName"]["value"]));
            $this->assertTrue("" !== $cartItem["product"]["productName"]["value"]);
            $this->assertTrue(!is_null($cartItem["product"]["price"]["value"]));
        }
    }
    function showCart() {
        $_obICartShowUseCase = resolve(ICartShowUseCase::class);
        $view = $_obICartShowUseCase->handle(new CartShowInputData("cart.show.show"));
        $this->checkShowCartViewModel($view);
    }
    protected function checkShowCartViewModel($view) {
        $this->assertTrue(!is_null($view));
        $data = $view->getData();
        $this->assertTrue(!is_null($data));
        $this->assertTrue(is_array($data));
        $this->assertTrue(0 < count($data));
        $this->assertTrue(isset($data["viewModel"]));
        /** @var array $viewModel */
        $viewModel = $data["viewModel"];
        $this->checkCartData($viewModel["cart"]);
    }
    function orderForm() {
        $_obIOrderFormUseCase = resolve(IOrderFormUseCase::class);
        $view = $_obIOrderFormUseCase->handle(new OrderFormInputData("order.form.form"));
        $this->checkOrderFormViewModel($view);
    }
    protected function checkOrderFormViewModel($view) {
        $this->assertTrue(!is_null($view));
        $data = $view->getData();
        $this->assertTrue(!is_null($data));
        $this->assertTrue(is_array($data));
        $this->assertTrue(0 < count($data));
        $this->assertTrue(isset($data["viewModel"]));
        /** @var array $viewModel */
        $viewModel = $data["viewModel"];
        $this->checkCartData($viewModel["cart"]);
    }
    protected function checkCartData(array $cartData) {
        $this->assertTrue(is_array($cartData));
        $this->assertTrue(!is_null($cartData["cartId"]["value"]));
        $this->assertTrue(!is_null($cartData["updDate"]["value"]));
        foreach($cartData["items"] as $cartItem) {
            /** @var array $cartItem */
            $this->assertTrue(!is_null($cartItem["cartId"]["value"]));
            $this->assertTrue(!is_null($cartItem["quantity"]["value"]));
            $this->assertTrue(!is_null($cartItem["product"]));
            $this->assertTrue(!is_null($cartItem["product"]["productId"]["value"]));
            $this->assertTrue(!is_null($cartItem["product"]["productName"]["value"]));
            $this->assertTrue("" !== $cartItem["product"]["productName"]["value"]);
            $this->assertTrue(!is_null($cartItem["product"]["price"]["value"]));
        }
    }
    function orderCheck() {
        $orderCheckUseCase = resolve(IOrderCheckUseCase::class);
        $this->orderCheckFunc($orderCheckUseCase, OrderCheckInputData::class);
    }
    function orderSave() {
        $orderSaveUseCase = resolve(IOrderSaveUseCase::class);
        $this->orderCheckFunc($orderSaveUseCase, OrderSaveInputData::class);
        $this->checkOrderSave();
    }
    protected function checkOrderSave() {
        $orderTable = \DB::table('test_schema.order_table')->orderBy("order_table_id", "DESC")->first();
        $this->assertTrue(!is_null($orderTable));
        $this->assertTrue("手酢戸" === $orderTable->last_name);
        $this->assertTrue("太郎" === $orderTable->first_name);
        $this->assertTrue("hatake.t14@gmail.com" === $orderTable->mail);
        $this->assertTrue("090-1111-2222" === $orderTable->tel);
        $this->assertTrue("100-0001" === $orderTable->zip);
        $this->assertTrue("東京都テスト区1-1-1" === $orderTable->address1);
        $insDate = strtotime($orderTable->ins_date);
        $now = strtotime(date('Y-m-d H:i:s'));
        $this->assertTrue(1 > (($now - $insDate) / 60));
    }
    function orderCheckFunc($usecase, string $inputDataClassName) {
        $view = $usecase->handle(new $inputDataClassName(
            "手酢戸", "太郎", "hatake.t14@gmail.com", "090-1111-2222", "100-0001", "東京都テスト区1-1-1"
        ));
        $this->checkValidationData($view->original->toArray(), []);
        if ($inputDataClassName === OrderSaveInputData::class) $this->addCart();
        $view = $usecase->handle(new $inputDataClassName(
            "", "太郎", "test@gmail.com", "090-1111-2222", "100-0001", "東京都テスト区1-1-1"
        ));
        $this->checkValidationData($view->original->toArray(), ["last_name"]);
        $view = $usecase->handle(new $inputDataClassName(
            "", "", "test@gmail.com", "090-1111-2222", "100-0001", "東京都テスト区1-1-1"
        ));
        $this->checkValidationData($view->original->toArray(), ["last_name", "first_name"]);
        $view = $usecase->handle(new $inputDataClassName(
            "", "", "test@gmail.comm", "090-1111-2222", "100-0001", "東京都テスト区1-1-1"
        ));
        $this->checkValidationData($view->original->toArray(), ["last_name", "first_name", "mail"]);
        $view = $usecase->handle(new $inputDataClassName(
            "", "", "te@st@gmail.com", "090-1111-22222", "100-0001", "東京都テスト区1-1-1"
        ));
        $this->checkValidationData($view->original->toArray(), ["last_name", "first_name", "mail", "tel"]);
        $view = $usecase->handle(new $inputDataClassName(
            "", "", "testgmail.com", "090-1111-2222-", "", "東京都テスト区1-1-1"
        ));
        $this->checkValidationData($view->original->toArray(), ["last_name", "first_name", "mail", "tel", "zip"]);
        $view = $usecase->handle(new $inputDataClassName(
            "", "", "", "", "100-00011", ""
        ));
        $this->checkValidationData($view->original->toArray(), ["last_name", "first_name", "mail", "tel", "zip", "address1"]);
    }
    protected function checkValidationData(array $view, array $errColumns) {
        $this->assertTrue(!is_null($view));
        $this->assertTrue(!is_null($view));
        $this->assertTrue(is_array($view));
        $this->assertTrue(isset($view["validationViewData"]["errors"]));
        $intCount = 0;
        foreach($view["validationViewData"]["errors"] as $key => $value) {
            $this->assertTrue(false !== array_search($key, $errColumns, true));
            $intCount += 1;
        }
        $this->assertTrue($intCount === count($errColumns));
    }
}
