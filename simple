#!/usr/bin/env php
<?php

$host = 'localhost';
$port = 80;

foreach ($argv as $arg)
{
    $arg = explode("=", trim($arg));

    if (strtolower($arg[0]) == 'host' AND isset($arg[1]))
    {
        $host = $arg[1];
    }

    if (strtolower($arg[0]) == 'port' AND isset($arg[1]))
    {
        $port = $arg[1];
    }
}

exec("php -S {$host}:{$port} -t public_html");