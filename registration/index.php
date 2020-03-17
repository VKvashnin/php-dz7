<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Dz7</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center custom-border">
				<h4>Registration form</h4>
				<form method="POST" onsubmit="sendData(); return false;" id="registerForm">
					<div>
						<div>Login</div>
						<input type="text" id="login" name="login">
						<div class="invalid-feedback"></div>
					</div>
					<div>
						<div>E-mail</div>
						<input type="text" id="mail" name="mail">
						<div class="invalid-feedback"></div>
					</div>
					<div>
						<div>Url к аватарке</div>
						<input type="text" id="image" name="image">
					</div>
					<div>
						<div>Password</div>
						<input type="password" id="pass" name="pass">
						<div class="invalid-feedback"></div>
					</div>
					<div>
						<div>Confirm password</div>
						<input type="password" id="confirm" name="pass-confirm">
						<div class="invalid-feedback"></div>
					</div>
					<button type="submit" class="btn btn-primary">Register</button>
				</form>
			</div>
		</div>
	</div>
</body>
<style type="text/css">
	.custom-border {border: 1px solid black; padding-bottom: 10px;}
	input {margin-bottom: 10px;}
</style>
<script type="text/javascript">
	function sendData() {
		let form = '#registerForm';
		let dataForm = $(form).serialize();

		$('*', form).removeClass('error');
		$('.invalid-feedback').empty();

		$.ajax({
			url: '../registration.server.php',
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
					document.location.href="../index.php";
				}
			}
		})
	}
</script>
</html>