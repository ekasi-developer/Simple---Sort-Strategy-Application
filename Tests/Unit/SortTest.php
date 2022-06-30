<?php

namespace Tests\Unit;

use Application\Services\Merge;
use Application\Services\Quick;
use Application\Services\Sort;
use Tests\TestCase;

class SortTest extends TestCase
{
    public function testSortUsingMergeStrategy(): void
    {
        $sort = new Sort(new Merge());

        $this->assertEquals(
            $sort->sort("QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm"),
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"
        );
    }

    public function testSortUsingQuicjStrategy(): void
    {
        $sort = new Sort(new Quick());

        $this->assertEquals(
            $sort->sort("QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm"),
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"
        );
    }
}