<?php

namespace Simple;

use Simple\Interfaces\SessionInterface;

class Session implements SessionInterface
{
    /**
     * Session data prefix.
     *
     * @var string
     */
    protected string $dataPrefix = 'data';

    /**
     * Session old data prefix.
     *
     * @var string
     */
    protected string $oldPrefix = 'old';

    /**
     * Session errors prefix.
     *
     * @var string
     */
    protected string $errorPrefix = 'errors';

    public function get(string $key): string
    {
        return $_SESSION["{$this->dataPrefix}.{$key}"] ?? '';
    }

    public function set(string $key, string $value): void
    {
        $_SESSION["{$this->dataPrefix}.{$key}"] = $value;
    }

    public function old(string $key): string
    {
        return $_SESSION["{$this->oldPrefix}.{$key}"] ?? '';
    }

    public function setOld(array|string $data, string|null $value=""): void
    {
        if (is_array($data))
        {
            foreach ($data as $key => $value)
            {
                $_SESSION["{$this->oldPrefix}.{$key}"] = $value;
            }
        }
        else
        {
            $_SESSION["{$this->dataPrefix}.{$data}"] = $value;
        }
    }

    public function error(string $key): string
    {
        return $_SESSION["{$this->errorPrefix}.{$key}"] ?? '';
    }

    public function setError(array|string $key, string $value): void
    {
        $_SESSION["{$this->errorPrefix}.{$key}"] = $value;
    }
}