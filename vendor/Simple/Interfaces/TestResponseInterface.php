<?php

namespace Simple\Interfaces;

use Simple\Testing\TestResponse;

interface TestResponseInterface
{
    /**
     * Check if response is view.
     *
     * @return TestResponse
     */
    public function assertIsView(): TestResponse;

    /**
     * Check if response is has given view.
     *
     * @param string $view
     * @return TestResponse
     */
    public function assertViewIs(string $view): TestResponse;

    /**
     * Check if view has given data.
     *+
     * @param mixed $data
     * @return TestResponse
     */
    public function assertViewHasData(mixed $data): TestResponse;

    /**
     * Check if view is redirect response or redirect. to given path.
     *
     * @param string|null $url
     * @return mixed
     */
    public function assertRedirect(string|null $url = null): TestResponse;

    /**
     * Check if session has given data.
     *
     * @param array|string $data
     * @return TestResponse
     */
    public function assertSessionHas(array|string $data): TestResponse;

    /**
     * Check session has given error.
     *
     * @param array|string $data
     * @return TestResponse
     */
    public function assertSessionHasErrors(array|string $data): TestResponse;
}