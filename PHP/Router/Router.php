<?php

namespace Router;

use Library\Log;

class Router
{
	public function dispatch()
	{
		$route = $this->parseAction();

		$controllerName = $route['controller'];
		$actionName = $route['action'];
		$logger = new Log();

		if (empty($controllerName) || empty($actionName)) {
			$logger->log("路由信息为空");
			return;
		}

		$controllerName = '\Controller\\' . ucwords($controllerName);

		if (class_exists($controllerName, true) == false) {
			$logger->log("访问的Controller不存在:".json_encode($route));
			return;
		}

		$controller = new $controllerName();

		if (method_exists($controller, $actionName) == false) {
			$logger->log("访问的方法不存在:".json_encode($route));
			return;
		}

		try {
			$controller->$actionName();
		} catch(Exception $exception) {
			$logger->log("调用异常:".$exception->getMessage());
		}
		
	}

	private function parseAction()
	{
		$routeUrl = $_SERVER['DOCUMENT_URI'];
		if (empty($routeUrl)) {
			$routeUrl = '';
		}

		// todo:异常处理

		$routeArr = explode('/', $routeUrl);
		$route = [
			'controller' => implode('\\', array_slice($routeArr, 2, count($routeArr) - 3)),
			'action' => $routeArr[count($routeArr) - 1],
		];

		return $route;
	}
}