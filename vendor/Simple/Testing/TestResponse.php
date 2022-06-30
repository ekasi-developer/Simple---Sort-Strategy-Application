<?php

namespace Simple\Testing;

use Simple\HandleRequest;
use Simple\Interfaces\TestResponseInterface;
use Simple\Redirect;
use Simple\Session;
use Simple\View;

class TestResponse extends \PHPUnit\Framework\TestCase implements TestResponseInterface
{
    protected View|Redirect $response;

    public function __construct(View|Redirect|HandleRequest $response)
    {
        parent::__construct();

        $this->response = $response;
    }

    public function assertIsView(): TestResponse
    {
        $this->assertInstanceOf(View::class, $this->response, 'Response must be a view.');

        return $this;
    }

    public function assertViewIs(string $view): TestResponse
    {
        $this->assertIsView();
        $this->assertEquals($view, $this->response->view(), 'View does not match.');

        return $this;
    }

    public function assertViewHasData(mixed $data): TestResponse
    {
        $this->assertIsView();

        if (is_array($data))
        {
            foreach ($data as $key => $value)
            {
                if (isset($value))
                {
                    $this->assertEquals($value, $this->response->data($key));
                }
                else
                {
                    $this->assertTrue(! is_null($this->response->data($key)), "{$key} not found.");
                }
            }
        }

        return $this;
    }

    public function assertRedirect(?string $url = null): TestResponse
    {
        $this->assertInstanceOf(Redirect::class, $this->response, 'Response must be a redirect.');

        if (! is_null($url))
        {

        }

        return $this;
    }

    public function assertSessionHas(array|string $data): TestResponse
    {
        $data = is_array($data) ? $data : [$data];

        foreach ($data as $key)
        {
            $this->assertTrue(!is_null(session($key)), "{$key} does not exist in error session.");
        }

        return $this;
    }

    public function assertSessionHasErrors(array|string $data): TestResponse
    {
        $data = is_array($data) ? $data : [$data];

        foreach ($data as $key)
        {
            $this->assertTrue(!is_null(error($key)), "{$key} does not exist in error session.");
        }

        return $this;
    }
}