<?php

namespace Simple;

use Simple\Interfaces\UrlInterface;

class Url implements UrlInterface
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function to(?string $uri = null, bool $secure = false): string
    {
        $prefix = $secure ? 'https://' : 'http://';

        return is_null($uri)
            ? "{$prefix}{$this->request->host()}"
            : "{$prefix}{$this->request->host()}/{$uri}";
    }

    public function previous(): string
    {
        return trim(str_replace($this->getHosts(), '', $this->request->previous()), '/');
    }

    /**
     * Get application secured and unsecured hostname.
     *
     * @return string[]
     */
    protected function getHosts(): array
    {
        return ["https://{$this->request->host()}", "http://{$this->request->host()}"];
    }
}