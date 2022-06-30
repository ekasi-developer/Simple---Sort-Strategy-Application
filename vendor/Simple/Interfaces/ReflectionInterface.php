<?php

namespace Simple\Interfaces;

use ReflectionException;
use Simple\HandleRequest;

interface ReflectionInterface
{
    /**
     * @param string $class
     * @param string $method
     * @return HandleRequest
     * @throws ReflectionException
     */
    public function resolve(string $class, string $method): HandleRequest;

    /**
     * Resolver given class name.
     *
     * @param string $class
     * @return object
     * @throws ReflectionException
     */
    public function classResolver(string $class): object;

    /**
     * Resolver given method in class.
     *
     * @param object $class
     * @param string $method
     * @return mixed
     * @throws ReflectionException
     */
    public function methodResolver(object $class, string $method): mixed;
}