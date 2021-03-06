<?php
namespace App\Controllers;
use \Ninja\DatabaseTable;

class Register {
	private $usersTable;

	public function __construct(DatabaseTable $usersTable) {
		$this->usersTable = $usersTable;
	}

	public function registrationForm() {
		return ['template' => 'register.html.php', 
				'title' => 'Register an account'];
	}


	public function success() {
		return ['template' => 'registersuccess.html.php', 
			    'title' => 'Registration Successful'];
	}

	public function registerUser() {
		$user = $_POST;

		//Assume the data is valid to begin with
		$valid = true;
		$errors = [];

		//But if any of the fields have been left blank, set $valid to false
		if (empty($user['firstname'])) {
			$valid = false;
			$errors[] = 'Name cannot be blank';
		}

		if (empty($user['lastname'])) {
			$valid = false;
			$errors[] = 'Name cannot be blank';
		}

		if (empty($user['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		}
		else if (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		}
		else { //if the email is not blank and valid:
			//convert the email to lowercase
			$user['email'] = strtolower($user['email']);

			//search for the lowercase version of `$user['email']`
			if (count($this->usersTable->find('email', $user['email'])) > 0) {
				$valid = false;
				$errors[] = 'That email address is already registered';
			}
		}


		if (empty($user['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}

		//If $valid is still true, no fields were blank and the data can be added
		if ($valid == true) {
			//Hash the password before saving it in the database
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

			//When submitted, the $user variable now contains a lowercase value for email
			//and a hashed password
			$this->usersTable->save($user);

			header('Location: index.php?login');
		}
		else {
			//If the data is not valid, show the form again
			return ['template' => 'register.html.php', 
				    'title' => 'Register an account',
				    'variables' => [
				    	'errors' => $errors,
				    	'user' => $user
				    ]
				   ]; 
		}
	}

	public function list() {
		$users = $this->usersTable->findAll();
		$count = $this->usersTable->total();

		return ['template' => 'admin_users_list.html.php',
				'title' => 'Users',
				'variables' => [
						'title' => 'Users',
						'count' => $count,
						'users' => $users
					]
				];
	}

	public function permissions() {

		$user = $this->usersTable->findById($_GET['id']);

		$reflected = new \ReflectionClass('\Ijdb\Entity\user');
		$constants = $reflected->getConstants();

		return ['template' => 'permissions.html.php',
				'title' => 'Edit Permissions',
				'variables' => [
						'user' => $user,
						'permissions' => $constants
					]
				];	
	}

	public function savePermissions() {
		$user = [
			'id' => $_GET['id'],
			'permissions' => array_sum($_POST['permissions'] ?? [])
		];

		$this->usersTable->save($user);

		header('location: /user/list');
	}

	public function show() {
		return [
			'template' => 'home.html.php',
			'title' => 'Home'
		];
	}
}