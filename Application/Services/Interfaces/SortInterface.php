<?php

namespace Application\Services\Interfaces;

interface SortInterface
{
    /**
     * Sort a string.
     *
     * @param string $value
     * @return string
     */
    public function sort(string $value): string;
}