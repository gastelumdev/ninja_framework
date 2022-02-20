<?php
namespace App;

class AppRoutes implements \Ninja\Routes {
	private $usersTable;
	private $jokesTable;
	private $authentication;

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$this->eventsTable = new \Ninja\DatabaseTable($pdo, 'event', 'id');
 		$this->usersTable = new \Ninja\DatabaseTable($pdo, 'user', 'id');
		$this->authentication = new \Ninja\Authentication($this->usersTable, 'email', 'password');
	}

	public function getRoutes(): array {
		$eventController = new \App\Controllers\Event($this->eventsTable, $this->authentication);
		$userController = new \App\Controllers\Register($this->usersTable);
		$loginController = new \App\Controllers\Login($this->authentication);

		$routes = [
			// ==========================================================================
			// PUBLIC HOME PAGE
			// ==========================================================================
			'' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'show'
				],
				'template' => 'layout_public.html.php'
			],
			// ==========================================================================
			// USERS
			// ==========================================================================
			'admin/users' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'list'
				],
				'template' => 'layout_admin.html.php'
			],
			'user/register' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'registrationForm'
				],
				'POST' => [
					'controller' => $userController,
					'action' => 'registerUser'
				],
				'template' => 'layout_auth.html.php'
			],
			'user/success' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'success'
				]
			],
			// ==========================================================================
			// EVENTS
			// ==========================================================================
			'admin/events' => [
				'GET' => [
					'controller' => $eventController,
					'action' => 'list'
				],
				'template' => 'layout_admin.html.php'
			],
			'admin/events/create' => [
				'POST' => [
					'controller' => $eventController,
					'action' => 'create'
				]
			],
			'admin/events/delete' => [
				'POST' => [
					'controller' => $eventController,
					'action' => 'delete'
				]
			],
			'admin/events/update' => [
				'POST' => [
					'controller' => $eventController,
					'action' => 'update'
				]
			],
			// ==========================================================================
			// AUTHENTICATION
			// ==========================================================================
			'login/error' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'error'
				],
				'template' => 'layout_admin.html.php'
			],
			'login/permissionserror' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'permissionsError'
				]
			],
			'login/success' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'success'
				]
			],
			'logout' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'logout'
				],
				'template' => 'layout_public.html.php'
			],
			'login' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'loginForm'
				],
				'POST' => [
					'controller' => $loginController,
					'action' => 'processLogin'
				],
				'template' => 'layout_auth.html.php'
			]
		];

		return $routes;
	}

	public function getAuthentication(): \Ninja\Authentication {
		return $this->authentication;
	}

	public function checkPermission($permission): bool {
		$user = $this->authentication->getUser();

		if ($user && $user->hasPermission($permission)) {
			return true;
		} else {
			return false;
		}
	}

}