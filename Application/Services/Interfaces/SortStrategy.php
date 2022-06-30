<?php

namespace Application\Services\Interfaces;

abstract class SortStrategy
{
    /**
     * Sort array using sort algorithm.
     *
     * @param array $value
     * @return array
     */
    public abstract function sort(array $value): array;
}