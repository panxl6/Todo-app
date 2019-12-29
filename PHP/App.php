<?php

use Library\Log;

function autoload($className) {
	$path = '';

	$className = str_replace("\\", "/", $className);

	if ($className[0] == "\\") {
		$path = __DIR__ . "/" . $className . '.php';
	} else {
		$path = __DIR__ . __NAMESPACE__ . "/" . $className . '.php';
	}

	include_once $path;
}

spl_autoload_register('autoload');

class App
{
	public function run()
	{
		$router = new Router\Router();
		$router->dispatch();
	}
}

function errorHandler($errno, $errstr, $errfile, $errline, $errcontext)
{
	$logger = new Log();
	$errcontext = json_encode($errcontext);
	$text = "错误码:{$errno}, \n错误信息: {$errstr}, \n错误文件: {$errfile}, \n错误行: {$errline}, \n上下文信息: {$errcontext}";
	$logger->log($text);
}

set_error_handler('errorHandler');
