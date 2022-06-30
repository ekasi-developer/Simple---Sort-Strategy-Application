<?php

/**
 * Autoload.
 *
 * Automatically load application class.
 */

include_once __DIR__ . '/../vendor/autoload.php';


/**
 * Bootstrap.
 *
 * Include required application resources.
 */

$application = require_once __DIR__ . '/../Application/bootstrap.php';

/**
 * Digest.
 *
 * Run application life cycle and builds application.
 */

$response = $application->digest();

/**
 * Response.
 *
 * Handle application response and returns it.
 */

$application->exit($response);