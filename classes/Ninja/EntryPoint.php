<?php
namespace Ninja;

class EntryPoint {
	private $route;
	private $method;
	private $routes;

	public function __construct(string $route, string $method, \Ninja\Routes $routes) {
		$this->route = $route;
		$this->routes = $routes;
		$this->method = $method;
		$this->checkUrl();
	}

	private function checkUrl() {
		if ($this->route !== strtolower($this->route)) {
			http_response_code(301);
			header('location: ' . strtolower($this->route));
		}
	}

	private function loadTemplate($templateFileName, $variables = []) {
		extract($variables);

		ob_start();
		include  __DIR__ . '/../../templates/' . $templateFileName;

		return ob_get_clean();
	}

	public function run() {

		$routes = $this->routes->getRoutes();	

		$authentication = $this->routes->getAuthentication();

		if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
			header('location: /login/error');
		}
		else if (isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])) {
			header('location: /login/permissionserror');	
		}
		else {
			$controller = $routes[$this->route][$this->method]['controller'];
			$action = $routes[$this->route][$this->method]['action'];
			$template = $routes[$this->route]['template'] ?? '';
			$page = $controller->$action();

			$title = $page['title'] ?? '';

			// 2021-07-01 OG NEW - if template is set, then load the template 
			if ($template != '') {
				if (isset($page['variables'])) {
					$output = $this->loadTemplate($page['template'], $page['variables']);
				}
				else {
					$output = $this->loadTemplate($page['template']);
				}
				
				echo $this->loadTemplate($template, ['loggedIn' => $authentication->isLoggedIn(),
															'output' => $output,
															'title' => $title,
															'route' => $this->route
															]);
				// 2021-07-01 OG NEW - else, echo the page variable that returns json 
			} else {
				echo $page;
			}
														
		}

	}
}