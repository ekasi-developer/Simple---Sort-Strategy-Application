<?php

namespace Simple;

use JetBrains\PhpStorm\Pure;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use Simple\Interfaces\ReflectionInterface;

class Reflection implements ReflectionInterface
{
    public function resolve(string $class, string $method): HandleRequest
    {
        return $this->methodResolver($this->classResolver($class), $method);
    }

    public function classResolver(string $class): object
    {
        $reflection = new ReflectionClass($class);

        if (! $this->hasConstructor($reflection))
            return $reflection->newInstance();

        $dependencies = $this->resolveDependencies(
            $reflection->getConstructor()->getParameters()
        );

        return $reflection->newInstanceArgs($dependencies);
    }

    public function methodResolver(object $class, string $method): mixed
    {
        $_method = new ReflectionMethod($class, $method);

        $dependencies = $this->resolveDependencies(
            $_method->getParameters()
        );

        foreach ($dependencies as $dependency)
            if($this->handleClass($dependency) AND !is_null($handle = $dependency->handle()))
                return $handle;

        return $_method->invoke($class, ...$dependencies);
    }

    /**
     * Check if given class is handle class.
     *
     * @param object $class
     * @return bool
     */
    protected function handleClass(object $class): bool
    {
        return $class instanceof FormRequest;
    }

    /**
     * Resolve class dependencies.
     *
     * @param array $parameters
     * @return ReflectionParameter[]
     * @throws ReflectionException
     */
    protected function resolveDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter)
            $dependencies[] = $this->isParameterClass($parameter) ?
                $this->classResolver($parameter->getType()->getName()) :
                $parameter->getDefaultValue();

        return $dependencies;
    }

    /**
     * Check if parameter is type of class.
     *
     * @param ReflectionParameter $parameter
     * @return bool
     */
    #[Pure]
    protected function isParameterClass(ReflectionParameter $parameter): bool
    {
        return $parameter->getType()
            AND $parameter->getType() instanceof ReflectionNamedType
            AND ! $parameter->getType()->isBuiltin();
    }

    /**
     * Check if class has constructor.
     *
     * @param ReflectionClass $class
     * @return bool
     */
    #[Pure]
    protected function hasConstructor(ReflectionClass $class): bool
    {
        return ! is_null($class->getConstructor());
    }
}