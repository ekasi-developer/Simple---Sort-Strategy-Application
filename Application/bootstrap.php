<?php

use Simple\Application;
use Simple\Request;

/**
 * Boostrap.
 *
 * Create simple framework and bootstrap simple framework.
 */

$application = Application::create(dirname(__FILE__, 2));

/**
 * Handle.
 *
 * Add request object to application.
 */

$application->handle(new Request);

/**
 * Return.
 *
 * Application instance.
 */
return $application;