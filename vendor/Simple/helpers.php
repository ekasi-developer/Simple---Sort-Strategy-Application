<?php


use JetBrains\PhpStorm\NoReturn;
use Simple\Application;
use Simple\Session;
use Simple\Url;

if (! function_exists('application'))
{
    /**
     * Get simple framework application instance.
     *
     * @param string|null $abstract
     * @return mixed
     */
    function application(string|null $abstract = null): mixed
    {
        if(is_null($abstract))
        {
            return Application::instance();
        }

        return Application::instance()->make($abstract);
    }
}

if (! function_exists('url'))
{
    /**
     * Generate url.
     *
     * @param string|null $uri
     * @param bool $secure
     * @return string
     */
    function url(string|null $uri = null, bool $secure = false): string
    {
        return application(Url::class)->to(is_null($uri) ? '' : $uri, $secure);
    }
}

if(! function_exists('debug'))
{
    /**
     * Print values.
     *
     * @param ...$values
     */
    function debug(...$values)
    {
        echo '<pre style="border: #e0e0e0; padding: 15px; background: #242628; color: #39e15f; border-radius: 5px;">';
        foreach ($values as $value)
        {
            print_r($value); echo  '<br><br>';
        }
        echo '</pre>';
    }
}

if(! function_exists('dump'))
{
    /**
     * Print values and kill script.
     *
     * @param $value
     */
    #[NoReturn]
    function dump(...$values): void
    {
        debug($values);
        exit();
    }
}

if(! function_exists('error'))
{
    /**
     * Print values and kill script.
     *
     * @param string $key
     * @return string|null
     */
    #[NoReturn]
    function error(string $key): string|null
    {
        return application(Session::class)->error($key);
    }
}

if(! function_exists('session'))
{
    /**
     * Get data from session.
     *
     * @return string|null
     */
    #[NoReturn]
    function session(string $key): string|null
    {
        return application(Session::class)->get($key);
    }
}

if(! function_exists('old'))
{
    /**
     * Get data from previous request if validation failed.
     *
     * @param string $key
     * @return string|null
     */
    #[NoReturn]
    function old(string $key): string|null
    {
        return application(Session::class)->old($key);
    }
}