<?php

namespace Simple;

use Simple\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    /**
     * Request get and post data.
     *
     * @var array $data
     */
    protected static array $data = [];

    /**
     * Request files data.
     *
     * @var array $files
     */
    protected static array $files = [];

    /**
     * Return this uri when uri method is called.
     *
     * @var string $uri
     */
    protected static string $uri;

    /**
     * Return this request method when method is called.
     *
     * @var string $method
     */
    protected static string $method;

    /**
     * Return this hostname when host is called.
     *
     * @var string $host
     */
    protected static string $host;

    /**
     * Return this previous route when previous is called.
     *
     * @var string $previous
     */
    protected static string $previous;

    public function __construct(array $data = [], array $files = [])
    {
        static::$data = array_merge(static::$data, $_GET, $_POST, $data);
        static::$files = array_merge(static::$data, $_FILES, $files);
    }

    public function all(): array
    {
        return static::$data;
    }

    public function get(string $key): string|null
    {
        return static::$data[$key] ?? null;
    }

    public function uri(): string
    {
        return static::$uri ?? trim($_SERVER['PATH_INFO'] ?? '', '/');
    }

    public function method(): string
    {
        return static::$method ?? $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function host(): string
    {
        return static::$host ?? $_SERVER['HTTP_HOST'];
    }

    public function previous(): string
    {
        return static::$previous ?? $_SERVER['HTTP_REFERER'];
    }

    public static function createNewInstance(string $uri, string $method, array $data = []): RequestInterface
    {
        static::$uri = $uri;
        static::$previous = '';
        static::$method = $method;
        static::$host = 'localhost';

        return new Request($data);
    }

    public static function clear(): void
    {
        static::$data = [];
        static::$files = [];
    }
}