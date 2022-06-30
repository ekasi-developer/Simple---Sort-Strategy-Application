<?php

namespace Test\Feature;

use Simple\Testing\TestResponse;
use Tests\TestCase;

class SortValueRequestTest extends TestCase
{
    public function testSortValueUsingQuickSortStrategy(): void
    {
        $this->sortRequest(['strategy' => 'Quick', 'value' => 'ecdab'])
            ->assertViewIs('home')
            ->assertViewHasData(['sorted' => 'abcde']);
    }

    public function testSortValueUsingMergeSortStrategy(): void
    {
        $this->sortRequest(['strategy' => 'Merge', 'value' => 'ecdab'])
            ->assertViewIs('home')
            ->assertViewHasData(['sorted' => 'abcde']);
    }

    public function testSortValueUsingEmptyData(): void
    {
        $this->sortRequest([])
            ->assertRedirect()
            ->assertSessionHasErrors(['strategy', 'value']);
    }

    public function testSortValueUsingShortData(): void
    {
        $this->sortRequest(['strategy' => 'Quick', 'value' => 'v'])
            ->assertRedirect()
            ->assertSessionHasErrors(['value']);
    }

    public function testSortValueUsingInvalidData(): void
    {
        $this->sortRequest(['strategy' => 'Bubble', 'value' => 'edcda'])
            ->assertRedirect()
            ->assertSessionHasErrors(['value']);
    }

    protected function sortRequest(array $data = []): TestResponse
    {
        return $this->post('', $data);
    }
}