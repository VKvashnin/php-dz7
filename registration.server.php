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
		$requestClass->required('mail');
		$requestClass->required('pass');
		$requestClass->required('pass-confirm');

		$requestClass->isEmail('mail');

		$requestClass->minLength('login', 5);
		$requestClass->minLength('pass', 4);
		$requestClass->minLength('pass-confirm', 4);

		$requestClass->maxLength('login', 20);
		$requestClass->maxLength('pass', 30);
		$requestClass->maxLength('pass-confirm', 30);

		$requestClass->passConfirm('pass', 'pass-confirm');

		$login = $requestClass->getField('login');
		$result = $db->is_registered('login', $login);
		if (!empty($result)) {
			//Логин уже зарегистрирован
			$requestClass->alredyRegistered('login');
		}

		if ($requestClass->getErrors())
		{
			echo json_encode($requestClass->getErrors());
		} else {
			$date = Date('Y-m-d H:m:s',time());
			$passMd5 = md5($requestClass->getField('pass'));
			$newUser = [
				"login" => $_POST['login'],
				"email" => $_POST['mail'],
				"password" => $passMd5,
				"image" => $_POST['image'],
				"create_at" => $date
			];
			$db->insert($newUser);

			$result = $db->is_registered('login', $login);
			$_SESSION['login'] = $result['login'];
			$_SESSION['image'] = $result['image'];
			$_SESSION['create_at'] = $result['create_at'];
			$_SESSION['login-status'] = 'logged';
			echo json_encode('done');
		}
	}
