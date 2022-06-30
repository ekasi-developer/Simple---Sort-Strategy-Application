<?php
namespace Simple\Interfaces;

use ReflectionException;
use Simple\Application;
use Simple\HandleRequest;

interface ApplicationInterface
{
    /**
     * Create simple framework instance.
     *
     * @param string $directory
     * @return ApplicationInterface
     */
    public static function create(string $directory): ApplicationInterface;

    /**
     * Handle or add application request.
     *
     * @param RequestInterface $request
     * @return ApplicationInterface
     */
    public function handle(RequestInterface $request): ApplicationInterface;

    /**
     * Runs application life cycle.
     *
     * @return HandleRequest
     */
    public function digest(): HandleRequest;

    /**
     * Terminate application and send response.
     *
     * @param HandleRequest|null $response
     */
    public function exit(HandleRequest $response = null): void;

    /**
     * Get application singleton instance.
     *
     * @return ApplicationInterface
     */
    public static function instance(): ApplicationInterface;

    /**
     * @param string $class
     * @return mixed
     * @throws ReflectionException
     */
    public function make(string $class): mixed;

    /**
     * Create instance for testing application.
     *
     * @param RequestInterface $request
     * @return HandleRequest
     */
    public function testingInstance(RequestInterface $request): HandleRequest;
}