<?php

namespace Tests;

use http\Env\Response;
use Simple\Application;
use Simple\Request;
use Simple\Testing\TestCase as BaseTest;

class TestCase extends BaseTest
{
    /**
     * Application instance.
     *
     * @var Application $application
     */
    protected Application $application;

    /**
     * Application response.
     *
     * @var Response $response
     */
    protected Response $response;

    protected function setUp(): void
    {
        $this->application = Application::create(dirname(__DIR__));

        $this->application->handle(new Request());

        $this->application->digest();
    }

    protected function tearDown(): void
    {
        $this->application->exit();
    }
}