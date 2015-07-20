<?php

class UsersTask extends Phalcon\CLI\Task {

	public function createAction($username, $password) {
		echo 'CREATING USER (' . $username . ')...' . PHP_EOL;
		if (User::findFirstByUsername($username)) {
			echo 'USER ALREADY EXISTS!' . PHP_EOL;
		} else {
			try {
				$user = new User();
				$user->setUsername($username);
				$user->setPassword($password);
				$user->save();
				echo 'CREATED.' . PHP_EOL;
			} catch (Exception $e) {
				echo 'ERROR:' . $e->getMessage() . PHP_EOL;
			}
		}
	}

	public function changePasswordAction($username, $password) {
		echo 'CHANGING USER (' . $username . ') PASSWORD...' . PHP_EOL;
		$user = User::findFirstByUsername($username);
		if (!$user) {
			echo 'USER NOT FOUND!' . PHP_EOL;
		} else {
			try {
				$user->setPassword($password);
				$user->save();
				echo 'PASSWORD UPDATED.' . PHP_EOL;
			} catch (Exception $e) {
				echo 'ERROR:' . $e->getMessage() . PHP_EOL;
			}
		}
	}
}