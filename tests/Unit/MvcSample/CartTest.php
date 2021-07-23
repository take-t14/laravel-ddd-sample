<?php

namespace Tests\Unit\MvcSample;

use Tests\Unit\DDDEcSample\CartTest as DDDCartTest;
use Packages\MvcSample\App\Http\Controllers\Api\CartController as ApiMvcCartController;
use Packages\MvcSample\App\Http\Controllers\Api\OrderController as ApiMvcOrderController;
use Packages\MvcSample\App\Http\Controllers\CartController as MvcCartController;
use Packages\MvcSample\App\Http\Controllers\OrderController as MvcOrderController;
use Packages\MvcSample\App\Http\Requests\OrderFormRequest;

class CartTest extends DDDCartTest
{
    function addCart() {
        $request = $this->createRequest("/mvc/cart/add"
            , MvcCartController::class, "add", "cart.show.show", ["productId" => "1", "quantity" => "3"]);
        \RequestEx::setRequest($request);
        $cartController = resolve(ApiMvcCartController::class);
        $jsonResponse = $cartController->add();
        $this->checkAddCartJson($jsonResponse->original["viewModel"]);
    }
    function showCart() {
        $request = $this->createRequest("/mvc/cart/show", MvcCartController::class, "list", "cart.show.show");
        \RequestEx::setRequest($request);
        $cartController = resolve(MvcCartController::class);
        $view = $cartController->list();
        $this->checkShowCartViewModel($view);
    }
    function orderForm() {
        $request = $this->createRequest("/mvc/order/form", MvcOrderController::class, "form", "order.form.form");
        \RequestEx::setRequest($request);
        $orderController = resolve(MvcOrderController::class);
        $view = $orderController->form();
        $this->checkOrderFormViewModel($view);
    }
    function orderCheck() {
        $this->mvcOrderCheckFunc("check");
    }
    function orderSave() {
        $this->mvcOrderCheckFunc("save");
    }
    function mvcOrderCheckFunc(string $controllerMethod) {
        $this->mvcOrderCheckFuncSub($controllerMethod, [
            "last_name" => "手酢戸", "first_name" => "太郎"
            , "mail" => "hatake.t14@gmail.com", "tel" => "090-1111-2222"
            , "zip" => "100-0001", "address1" => "東京都テスト区1-1-1"
        ], []);
        if ("save" === $controllerMethod) $this->addCart();
        $this->mvcOrderCheckFuncSub($controllerMethod, [
            "last_name" => "", "first_name" => "太郎"
            , "mail" => "hatake.t14@gmail.com", "tel" => "090-1111-2222"
            , "zip" => "100-0001", "address1" => "東京都テスト区1-1-1"
        ], ["last_name"]);
        $this->mvcOrderCheckFuncSub($controllerMethod, [
            "last_name" => "", "first_name" => ""
            , "mail" => "hatake.t14@gmail.com", "tel" => "090-1111-2222"
            , "zip" => "100-0001", "address1" => "東京都テスト区1-1-1"
        ], ["last_name", "first_name"]);
        $this->mvcOrderCheckFuncSub($controllerMethod, [
            "last_name" => "", "first_name" => ""
            , "mail" => "hatake.t14@gmail.comm", "tel" => "090-1111-2222"
            , "zip" => "100-0001", "address1" => "東京都テスト区1-1-1"
        ], ["last_name", "first_name", "mail"]);
        $this->mvcOrderCheckFuncSub($controllerMethod, [
            "last_name" => "", "first_name" => ""
            , "mail" => "te@st@gmail.com", "tel" => "090-1111-22222"
            , "zip" => "100-0001", "address1" => "東京都テスト区1-1-1"
        ], ["last_name", "first_name", "mail", "tel"]);
        $this->mvcOrderCheckFuncSub($controllerMethod, [
            "last_name" => "", "first_name" => ""
            , "mail" => "testgmail.com", "tel" => "090-1111-2222-"
            , "zip" => "", "address1" => "東京都テスト区1-1-1"
        ], ["last_name", "first_name", "mail", "tel", "zip"]);
        $this->mvcOrderCheckFuncSub($controllerMethod, [
            "last_name" => "", "first_name" => ""
            , "mail" => "", "tel" => ""
            , "zip" => "100-00011", "address1" => ""
        ], ["last_name", "first_name", "mail", "tel", "zip", "address1"]);
    }
    function mvcOrderCheckFuncSub(string $controllerMethod, array $requestDatas, $errColumns) {
        list($formRequest, $errors) = $this->checkFormRequest(OrderFormRequest::class, $requestDatas);
        $this->checkValidationData($errors, $errColumns);
        if (is_null($formRequest)) {
            return;
        }
        \RequestEx::setRequest($formRequest);
        $orderController = resolve(ApiMvcOrderController::class);
        $orderController->$controllerMethod($formRequest);
    }
    protected function checkValidationData($errors, array $errColumns) {
        $this->assertTrue(isset($errors));
        $intCount = 0;
        foreach($errors as $key => $value) {
            $this->assertTrue(false !== array_search($key, $errColumns, true));
            $intCount += 1;
        }
        $this->assertTrue($intCount === count($errColumns));
    }
}
