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
			return false;
		}

		$controllerName = '\Controller\\' . ucwords($controllerName);

		if (class_exists($controllerName, true) == false) {
			$logger->log("访问的Controller不存在:".json_encode($route));
			return false;
		}

		$controller = new $controllerName();
		if (method_exists($controller, $actionName) == false) {
			$logger->log("访问的方法不存在:".json_encode($route));
			return false;
		}

		try {
			$controller->$actionName();
		} catch(Exception $exception) {
			$logger->log("调用异常:".$exception->getMessage());
			return false;
		}
		return true;	
	}

	private function parseAction()
	{
		$routeUrl = $_SERVER['DOCUMENT_URI'];
		if (empty($routeUrl)) {
			$routeUrl = '';
		}

		$routeArr = explode('/', $routeUrl);
		if (empty($routeArr) || count($routeArr)<3) {
			return [
				'controller' => '/',
				'action' => ''
			];
		}
		$route = [
			'controller' => implode('\\', array_slice($routeArr, 2, count($routeArr) - 3)),
			'action' => $routeArr[count($routeArr) - 1],
		];

		return $route;
	}
}