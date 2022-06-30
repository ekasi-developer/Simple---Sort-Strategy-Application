<?php

namespace Simple\Interfaces;

interface RequestInterface
{
    /**
     * Get all request data.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Get value from request data.
     *
     * @param string $key
     * @return string|null
     */
    public function get(string $key): string|null;

    /**
     * Get request uri.
     *
     * @return string
     */
    public function uri(): string;

    /**
     * Get request method.
     *
     * @return string
     */
    public function method(): string;

    /**
     * Get server hostname.
     *
     * @return string
     */
    public function host(): string;

    /**
     * Get the previous route uri.
     *
     * @return string
     */
    public function previous(): string;

    /**
     * Create new request instance.
     *
     * @param string $uri
     * @param string $method
     * @param array $data
     * @return RequestInterface
     */
    public static function createNewInstance(string $uri, string $method, array $data = []): RequestInterface;

    /**
     * Clear/Reset data and files.
     *
     * @return void
     */
    public static function clear(): void;
}