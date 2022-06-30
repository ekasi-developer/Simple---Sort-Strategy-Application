<?php

namespace Simple;

abstract class HandleRequest
{
    /**
     * Handle application response.
     *
     * @return void
     */
    public abstract function handle(): void;
}