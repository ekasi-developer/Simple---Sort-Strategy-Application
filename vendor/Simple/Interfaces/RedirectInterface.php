<?php

namespace Simple\Interfaces;

interface RedirectInterface
{
    /**
     * Redirect application to given uri.
     *
     * @param string $uri
     * @return RedirectInterface
     */
    public static function to(string $uri): RedirectInterface;

    /**
     * Redirect application to previous uri.
     *
     * @return RedirectInterface
     */
    public static function back(): RedirectInterface;
}