<?php

namespace Packages\Common\Frameworks\Facades;

use Illuminate\Support\Facades\Facade;

class SessionRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Packages\Common\UseCase\Common\ISessionRepository::class;
    }
}