<?php

class UsersTask extends Phalcon\CLI\Task {

	public function createAction($username, $password) {
		echo 'CREATING USER (' . $username . ')...' . PHP_EOL;
		if (User::findFirstByUsername($username)) {
			echo 'USER ALREADY EXISTS!' . PHP_EOL;
		} else {
			$user = new User();
			$user->setUsername($username);
			$user->setPassword($password);
			if (!$user->save()) {
				echo 'ERROR:' . PHP_EOL;
				foreach ($user->getMessages() as $message) {
					echo $message->getMessage() . PHP_EOL;
				}
			} else {
				echo 'CREATED.' . PHP_EOL;
			}
		}
	}

	public function changePasswordAction($username, $password) {
		echo 'CHANGING USER (' . $username . ') PASSWORD...' . PHP_EOL;
		$user = User::findFirstByUsername($username);
		if (!$user) {
			echo 'USER NOT FOUND!' . PHP_EOL;
		} else {
			$user->setPassword($password);
			if (!$user->save()) {
				echo 'ERROR:' . PHP_EOL;
				foreach ($user->getMessages() as $message) {
					echo $message->getMessage() . PHP_EOL;
				}
			} else {
				echo 'PASSWORD UPDATED.' . PHP_EOL;
			}
		}
	}
}