<?php

namespace Simple\Testing;

use Simple\Application;
use Simple\HandleRequest;
use Simple\Request;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Application instance.
     *
     * @var Application $application
     */
    protected Application $application;

    /**
     * Get request to application.
     *
     * @param string $uri
     * @param array $data
     * @return TestResponse
     */
    public function get(string $uri, array $data = []): TestResponse
    {
        return new TestResponse(
            $this->request($uri, 'GET', $data)
        );
    }

    /**
     * Post request to application.
     *
     * @param string $uri
     * @param array $data
     * @return TestResponse
     */
    public function post(string $uri, array $data = []): TestResponse
    {
        return new TestResponse(
            $this->request($uri, 'POST', $data)
        );
    }

    /**
     * PATCH request to application.
     *
     * @param string $uri
     * @param array $data
     * @return TestResponse
     */
    public function patch(string $uri, array $data = []): TestResponse
    {
        return new TestResponse(
            $this->request($uri, 'PATCH', $data)
        );
    }

    /**
     * DELETE request to application.
     *
     * @param string $uri
     * @param array $data
     * @return TestResponse
     */
    public function delete(string $uri, array $data = []): TestResponse
    {
        return new TestResponse(
            $this->request($uri, 'DELETE', $data)
        );
    }

    protected function request(string $uri, string $method, array $data): HandleRequest
    {
        return $this->application->testingInstance(
            Request::createNewInstance($uri, $method, $data)
        );
    }
}