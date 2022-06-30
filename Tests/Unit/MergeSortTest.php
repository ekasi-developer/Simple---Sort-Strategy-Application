<?php

namespace Tests\Unit;

use Application\Services\Interfaces\SortStrategy;
use Application\Services\Merge;
use Tests\TestCase;

class MergeSortTest extends TestCase
{
    protected SortStrategy $strategy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->strategy = new Merge();
    }

    public function testSortArrayWithSmallLetters(): void
    {
        $expected = 'abcdefghijklmnopqrstuvwxyz';
        $actual = implode(
            '', $this->strategy->sort(str_split("qwertyuiopasdfghjklzxcvbnm"))
        );

        $this->assertEquals($expected, $actual);
    }

    public function testSortArrayWithSmallAndBigLetters(): void
    {
        $expected = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $actual = implode(
            '', $this->strategy->sort(str_split("QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm"))
        );

        $this->assertEquals($expected, $actual);
    }

    public function testSortArrayWithNumbers(): void
    {
        $this->assertEquals(
            [0,1,2,3,4,5,6,7,8,9], $this->strategy->sort([9,8,7,6,5,4,3,2,1,0])
        );
    }
}