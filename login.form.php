<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
	<div class="text-center custom-border-login-form">
		<h4>Login form</h4>
		<form method="post" onsubmit="sendData(); return false;" id="loginForm">
			<div>
				<div>Login</div>
				<input type="text" id="login" name="login">
				<div class="invalid-feedback"></div>
			</div>
			<div>
				<div>Password</div>
				<input type="password" id="pass" name="pass">
				<div class="invalid-feedback"></div>
			</div>
			<div class="custom-margin-login-form">
				<button type="submit" class="btn btn-primary">Login</button>
				<a href="registration" class="btn btn-primary">Register</a>
			</div>
		</form>
	</div>
</body>
<style type="text/css">
	.custom-border-login-form {border: 1px solid black; padding-bottom: 10px; padding-top: 10px;}
	.custom-margin-login-form {margin-top: 10px;}
</style>
<script type="text/javascript">
	function sendData() {
		let form = '#loginForm';
		let dataForm = $(form).serialize();

		$('*', form).removeClass('error');
		$('.invalid-feedback').empty();

		$.ajax({
			url: 'login.server.php',
			type: 'POST',
			dataType: 'json',
			data: dataForm,
			success: function(responce) {
				if (responce !== 'done') {
					for(key in responce)
					{
						$(`[name="${key}"]`, form).addClass('error');
						$(`[name="${key}"]`, form).siblings('.invalid-feedback')
							.html( responce[key]
							.join("<br>") )
							.show();
					}
				} else {
					document.location.reload(true);
				}
			}
		})
	}
</script>
</html>
