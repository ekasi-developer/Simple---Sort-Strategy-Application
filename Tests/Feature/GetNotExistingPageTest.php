<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetNotExistingPageTest extends TestCase
{
    public function testGetInvalidPage(): void
    {
        $this->get('strategies')
            ->assertViewIs('404');
    }
}