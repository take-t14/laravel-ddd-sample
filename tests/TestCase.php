<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function assertString($value = null) {
        $this->assertTrue(!is_null($value));
        $this->assertTrue("" !== $value);
    }
    /**
     * @param  array   $queryParameters
     * @param  array   $routeParameters
     * @return Request
     */
    protected function createRequest(
        string $url
        , string $controllerName
        , string $controllerMethod
        , string $routeName
        , array $routeParameters = []
        , array $queryParameters = []
    ): Request {
        $request = Request::create(
            route($routeName, $routeParameters),
            Request::METHOD_GET,
            $queryParameters
        );
 
        $request->setRouteResolver(function () use ($url, $controllerName, $controllerMethod, $routeName, $request) {
            $route = Route::get($url, [$controllerName, $controllerMethod])->name($routeName);
            return $route->bind($request);
        });
 
        return $request;
    }
    protected function checkFormRequest(string $formRequestClassName, array $requestDatas) : array {
        $this->app->resolving($formRequestClassName, function ($resolved) use ($requestDatas){
            $resolved->merge($requestDatas);
        });
 
        try {
            $formRequest = app($formRequestClassName);
            return [$formRequest, []];
        } catch (ValidationException $e) {
            return [null, $e->errors()];
        }
    }
}
