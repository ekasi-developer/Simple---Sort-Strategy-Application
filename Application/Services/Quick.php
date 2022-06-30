<?php

namespace Application\Services;

use Application\Services\Interfaces\SortStrategy;

class Quick extends SortStrategy
{
    public function sort(array $value): array
    {
        $loe = $gt = array();

        if(count($value) < 2)
        {
            return $value;
        }

        $pivot_key = key($value);
        $pivot = array_shift($value);

        foreach($value as $val)
        {
            if($val <= $pivot)
            {
                $loe[] = $val;
            }
            elseif ($val > $pivot)
            {
                $gt[] = $val;
            }
        }

        return array_merge(
            $this->sort($loe),
            array($pivot_key=>$pivot),
            $this->sort($gt)
        );
    }
}