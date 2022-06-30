<?php

namespace Application\Services;

use Application\Services\Interfaces\SortStrategy;

class Merge extends SortStrategy
{
    public function sort(array $value): array
    {
        usort($value, function ($first, $second) {
            return $first == $second ? 0 : strtolower($first < $second ? -1 : 1);
        });

        return $value;
    }
}