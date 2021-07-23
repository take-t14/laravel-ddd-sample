<?php
namespace Packages\MvcSample\App\Http\Controllers;

trait DynamicMethodDeclaration
{
    /**
     * @var \Closure[]
     */
    private $__dynamicMethods = [];

    public function addMethod(string $name, \Closure $method): void
    {
        $this->__dynamicMethods[$name] = $method->bindTo($this, self::class);
    }

    public function __call(string $name, array $arguments)
    {
        if (!array_key_exists($name, $this->__dynamicMethods)) {
            throw new \BadMethodCallException(
                'Call to undefined method ' . __CLASS__ . "::$name()"
            );
        }
        return $this->__dynamicMethods[$name](...$arguments);
    }
}

class MyObject
{
    use DynamicMethodDeclaration;

    private $foo = 'foo';
}