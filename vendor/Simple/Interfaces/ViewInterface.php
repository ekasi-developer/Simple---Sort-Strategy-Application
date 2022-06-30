<?php

namespace Simple\Interfaces;

interface ViewInterface
{
    /**
     * Get the current view.
     *
     * @return string
     */
    public function view(): string;

    /**
     * Get view data.
     *
     * @param string|null $key
     * @return mixed
     */
    public function data(string $key = null): mixed;

    /**
     * Create new view instance.
     *
     * @param string $view
     * @param array $data
     * @return ViewInterface
     */
    public static function make(string $view, array $data = []): ViewInterface;

    /**
     * Set base application directory.
     *
     * @param string $directory
     * @return void
     */
    public static function setDirectory(string $directory): void;

    /**
     * Set application directory compiled view.
     *
     * @param string $directory
     * @return void
     */
    public static function setCompiledDirectory(string $directory): void;
}