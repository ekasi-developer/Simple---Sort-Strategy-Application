<?php

namespace Application\Services;

use Application\Services\Interfaces\SortInterface;
use Application\Services\Interfaces\SortStrategy;

class Sort implements SortInterface
{
    /**
     * Sort algorithm.
     *
     * @var SortStrategy
     */
    protected SortStrategy $strategy;

    /**
     * @param SortStrategy $strategy
     */
    public function __construct(SortStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function sort(string $value): string
    {
        return implode(
            $this->strategy->sort(
                str_split($value)
            )
        );
    }
}