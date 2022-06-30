<?php

namespace Simple;

use Simple\Interfaces\RedirectInterface;

class Redirect extends HandleRequest implements RedirectInterface
{
    /**
     * URI to redirect to.
     *
     * @var string $uri
     */
    protected string $uri;

    /**
     * Application url generator.
     *
     * @var Url $url
     */
    protected Url $url;

    public function __construct(Url $url, string $uri = '')
    {
        $this->url = $url;
        $this->uri = $uri;
    }

    public static function to(string $uri): RedirectInterface
    {
        return new Redirect(new Url(new Request()), $uri);
    }

    public static function back(): RedirectInterface
    {
        return new Redirect(new Url(new Request()), ':back');
    }

    public function handle(): void
    {
        if ($this->uri == ':back')
        {
            header("Location: {$this->url->to($this->url->previous())}");
        }
        else
        {
            header("Location: {$this->url->to($this->uri)}");
        }

        exit();
    }
}