<?php
namespace App;

class AppRoutes implements \Ninja\Routes {
	private $usersTable;
	private $jokesTable;
	private $authentication;

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$this->jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
 		$this->usersTable = new \Ninja\DatabaseTable($pdo, 'user', 'id');
		$this->authentication = new \Ninja\Authentication($this->usersTable, 'email', 'password');
	}

	public function getRoutes(): array {
		$jokeController = new \App\Controllers\Joke($this->jokesTable, $this->usersTable, $this->authentication);
		$userController = new \App\Controllers\Register($this->usersTable);
		$loginController = new \App\Controllers\Login($this->authentication);

		$routes = [
			'admin/users' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'list'
				]
			],
			'user/register' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'registrationForm'
				],
				'POST' => [
					'controller' => $userController,
					'action' => 'registerUser'
				]
			],
			'user/success' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'success'
				]
			],
			'user/list' => [
				'GET' => [
					'controller' => $userController,
					'action' => 'list'
				],
				'login' => true
			],
			'joke/edit' => [
				'POST' => [
					'controller' => $jokeController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $jokeController,
					'action' => 'edit'
				],
				'login' => true
			],
			'joke/delete' => [
				'POST' => [
					'controller' => $jokeController,
					'action' => 'delete'
				],
				'login' => true
			],
			'joke/list' => [
				'GET' => [
					'controller' => $jokeController,
					'action' => 'list'
				]
			],
			'login/error' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'error'
				]
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
				]
			],
			'login' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'loginForm'
				],
				'POST' => [
					'controller' => $loginController,
					'action' => 'processLogin'
				]
			],
			'' => [
				'GET' => [
					'controller' => $jokeController,
					'action' => 'home'
				]
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