<?php
	session_start();

	use Academy\db;
	require_once __DIR__ . '/vendor/autoload.php';
	$db = new db();
	$db->table_name = 'users';

	require_once "request.class.php";
	$requestClass = new Request();

	if( $requestClass->isPost() )
	{
		$requestClass->required('login');
		$requestClass->required('pass');

		$requestClass->minLength('login', 5);
		$requestClass->minLength('pass', 4);

		$requestClass->maxLength('login', 20);
		$requestClass->maxLength('pass', 30);

		if ($requestClass->getErrors())
		{
			echo json_encode($requestClass->getErrors());
		} else {
			//login check
			$login = $requestClass->getField('login');
			$result = $db->is_registered('login', $login);
			if (!empty($result)) {
				$passCheck = md5($requestClass->getField('pass'));
				if ($passCheck === $result['password']) {
					//login success
					$_SESSION['login'] = $result['login'];
					$_SESSION['image'] = $result['image'];
					$_SESSION['create_at'] = $result['create_at'];
					$_SESSION['login-status'] = 'logged';
					echo json_encode('done');
				} else {
					//wrong password
					$requestClass->wrongPassword('pass');
					echo json_encode($requestClass->getErrors());
				}

			} else {
				//wrong login
				$requestClass->notRegistered('login');
				echo json_encode($requestClass->getErrors());
			}
		}
	}