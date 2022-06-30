<?php

namespace Simple\Interfaces;

use Simple\HandleRequest;

interface RouterInterface
{
    /**
     * Push route into routes.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     * @param string $method
     * @return void
     */
    public static function push(string $uri, string $controller, string $action, string $method): void;

    /**
     * Get route using uri.
     *
     * @param string $uri
     * @param string $method
     * @return HandleRequest
     */
    public function route(string $uri, string $method): HandleRequest;
}