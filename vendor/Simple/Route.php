<?php

namespace Simple;

use Simple\Interfaces\RouteInterface;

class Route implements RouteInterface
{
    /**
     * Handle a get request form uri.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     */
    public static function get(string $uri, string $controller, string $action)
    {
        Router::push($uri, $controller, $action, 'GET');
    }

    /**
     * Handle a post request for uri.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     */
    public static function post(string $uri, string $controller, string $action)
    {
        Router::push($uri, $controller, $action, 'POST');
    }

    /**
     * Handle a patch request for uri.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     */
    public static function patch(string $uri, string $controller, string $action)
    {
        Router::push($uri, $controller, $action, 'PATCH');
    }

    /**
     * Handle a delete request for uri.
     *
     * @param string $uri
     * @param string $controller
     * @param string $action
     */
    public static function delete(string $uri, string $controller, string $action)
    {
        Router::push($uri, $controller, $action, 'DELETE');
    }
}