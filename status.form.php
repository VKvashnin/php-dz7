<?php
	session_start();
	if (array_key_exists('login-status', $_SESSION)){
		if ($_SESSION['login-status'] === 'logged') {
			include ("login.status.php");
		}
	} else {
		include ("login.form.php");
	}