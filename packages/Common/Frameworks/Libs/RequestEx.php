<?php

namespace Packages\Common\Frameworks\Libs;

class RequestEx
{
    private $request = null;
    function __construct() {
        if (!is_null(request())) {
            $this->request = request();
        }
    }
    public function setRequest($request) {
        $this->request = $request;
    }
    public function get($key, $defaultValue = null) {
        if (isset($this->request->$key)) {
            return $this->request->$key;
        }
        return $defaultValue;
    }
    public function getRoute() {
        return $this->request->route();
    }
}