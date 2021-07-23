<?php

namespace Packages\Common\Frameworks\Facades;

use Illuminate\Support\Facades\Facade;

class RequestEx extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "RequestEx";
    }
}