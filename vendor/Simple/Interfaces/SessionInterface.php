<?php

namespace Simple\Interfaces;

interface SessionInterface
{
    /**
     * Get value from session.
     *
     * @param string $key
     * @return string
     */
    public function get(string $key): string;

    /**
     * Set value form session.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function set(string $key, string $value): void;

    /**
     * Get value from previous request.
     *
     * @param string $key
     * @return string
     */
    public function old(string $key): string;

    /**
     * Get value from previous request.
     *
     * @param string|array $data
     * @return void
     */
    public function setOld(string|array $data, string $value = null): void;

    /**
     * Get error from session
     *
     * @param string $key
     * @return string
     */
    public function error(string $key): string;

    /**
     * @param string|array $key
     * @param string $value
     * @return void
     */
    public function setError(string|array $key, string $value): void;
}