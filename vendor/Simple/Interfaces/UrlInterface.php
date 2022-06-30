<?php

namespace Simple\Interfaces;

interface UrlInterface
{
    /**
     * Generate url.
     *
     * @param string|null $uri
     * @param bool $secure
     * @return string
     */
    public function to(string|null $uri = null, bool $secure = false): string;

    /**
     * Get previous uri.
     *
     * @return string
     */
    public function previous(): string;
}