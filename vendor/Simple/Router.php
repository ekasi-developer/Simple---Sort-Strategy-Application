<?php

namespace Simple;

use Exception;
use Simple\Interfaces\RouterInterface;

class Router implements RouterInterface
{
    /**
     * List of routes.
     *
     * @var array $router
     */
    public static array $routes = [];

    /**
     * Application bass directory.
     *
     * @var string
     */
    private string $directory;

    /**
     * Reflection automatic injection.
     *
     * @var Reflection $reflection
     */
    private Reflection $reflection;

    /**
     * @param string $directory
     * @param Reflection $reflection
     */
    public function __construct(string $directory, Reflection $reflection)
    {
        $this->directory = $directory;
        $this->reflection = $reflection;
    }

    public static function push(string $uri, string $controller, string $action, string $method): void
    {
        if (!isset(self::$routes[$uri]))
        {
            self::$routes[$uri] = [$method => ['controller' => $controller, 'action' => strtolower($action)]];
            return;
        }
        self::$routes[$uri][$method] = ['controller' => $controller, 'action' => strtolower($action)];
    }

    public function route(string $uri, string $method): HandleRequest
    {
        try
        {
            $route = $this->getRoute($uri, $method);
        }
        catch (Exception $exception)
        {
            return View::make('404', ['message' => $exception->getMessage()]);
        }

        return $this->getController($route['controller'], $route['action']);
    }

    /**
     * Get route in route list.
     *
     * @param string $uri
     * @param string $method
     * @return array
     * @throws Exception
     */
    protected function getRoute(string $uri, string $method): array
    {
        if (! isset(self::$routes[$uri]))
            throw new Exception("The route {$uri} does not exist.");

        if (! isset(self::$routes[$uri][$method]))
            throw new Exception("The method {$method} in route {$uri} does not exists.");

        return self::$routes[$uri][$method];
    }

    /**
     * Get controller namespace.
     *
     * @param string $controller
     * @return string
     * @throws Exception
     */
    protected function getControllerNamespace(string $controller): string
    {
        $namespace = "Application\\Controllers\\{$controller}";

        if (! file_exists("{$this->directory}\\{$namespace}.php"))
            throw new Exception("The {$controller} controller does not exists.");

        return "Application\\Controllers\\{$controller}";
    }

    private function getController(string $controller, string $action): HandleRequest
    {
        try
        {
            $handle = $this->reflection->resolve(
                $this->getControllerNamespace($controller), $action
            );
        }
        catch (Exception $exception)
        {
            return View::make('404', ['message' => $exception->getMessage()]);
        }

        return $handle;
    }
}