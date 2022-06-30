<?php

namespace Simple;

use Exception;
use Simple\Interfaces\ApplicationInterface;
use Simple\Interfaces\RequestInterface;

class Application implements ApplicationInterface
{
    /**
     * Application single instance.
     *
     * @var ApplicationInterface
     */
    protected static ApplicationInterface $instance;

    /**
     * Application base directory.
     *
     * @var string $dir
     */
    protected static string $directory;

    /**
     * Application request.
     *
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * Application router.
     *
     * @var Router $router
     */
    protected Router $router;

    /**
     * Reflection automatic loader class.
     *
     * @var Reflection $reflection
     */
    protected Reflection $reflection;

    /**
     * Create new simple framework application instance.
     *
     * @param string $directory
     * @param Router $router
     * @param Reflection $reflection
     */
    public function __construct(string $directory, Router $router, Reflection $reflection)
    {
        $this->reflection = $reflection;
        static::$directory = $directory;
        $this->router = $router;
    }

    public static function create(string $directory): ApplicationInterface
    {
        $reflection = new Reflection();

        static::$instance = new Application(
            $directory, new Router($directory, $reflection), $reflection
        );

        return static::$instance;
    }

    public function handle(RequestInterface $request): ApplicationInterface
    {
        session_start();

        $this->request = $request;

        return $this;
    }

    public function digest(): HandleRequest
    {
        return $this->build();
    }

    public function exit(HandleRequest $response = null): void
    {
        is_null($response)?: $response->handle();

        $this->cleanUp();
    }

    public static function instance(): ApplicationInterface
    {
        return self::$instance;
    }

    public function make(string $class): object
    {
        return $this->reflection->classResolver($class);
    }

    public function testingInstance(RequestInterface $request): HandleRequest
    {
        $this->request = $request;

        return $this->digest();
    }

    /**
     * Build application resources.
     *
     * @return HandleRequest
     * @throws Exception
     */
    protected function build(): HandleRequest
    {
        $this->helpers();
        $this->loadRoutes();
        $this->setPaths();

        return $this->router->route(
            $this->request->uri(), strtoupper($this->request->method())
        );
    }

    /**
     * Load application helpers functions.
     *
     * @return void
     */
    protected function helpers(): void
    {
        require_once static::$directory . "\\vendor\\Simple\\helpers.php";
    }

    /**
     * Set dependency paths.
     *
     * @return void
     */
    protected function setPaths(): void
    {
        View::setDirectory(static::$directory);
        View::setCompiledDirectory(static::$directory . "/Storage/Views");
        Validator::langDir(static::$directory . "/lang");
    }

    /**
     * Load application routes.
     *
     * @return void
     * @throws Exception
     */
    protected function loadRoutes(): void
    {
        if (! file_exists($routes = static::$directory . "\\Application\\Routes\\web.php"))
            throw new Exception("Error the routes file does not exists in : {$routes}");

        require_once $routes;
    }

    /**
     * Clean up application on destroy.
     */
    protected function cleanUp(): void
    {
        Request::clear();

        session_destroy();
    }
}