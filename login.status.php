<?php
	if(isset($_POST['logout'])) {
		if (array_key_exists('login-status', $_SESSION)){
			unset($_SESSION['login']);
			unset($_SESSION['image']);
			unset($_SESSION['create_at']);
			unset($_SESSION['login-status']);
			header('Location: '.$_SERVER['REQUEST_URI']);
		}
	}
?>
<body>
	<div class="text-center custom-border-login-form">
		<div class="text-center">
			<div><?php echo "User: {$_SESSION['login']}"; ?></div>
			<div>
				<img src="<?php echo $_SESSION['image']; ?>">
			</div>
			<div><?php echo "Registration: {$_SESSION['create_at']}"; ?></div>
		</div>
		<form method="post" action="">
			<button type="submit" name="logout">Logout</button>
		</form>
	</div>
</body>