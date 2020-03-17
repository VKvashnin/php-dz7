<?php
	use Academy\db;
	require_once __DIR__ . '/vendor/autoload.php';
	$db = new db();
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Dz7</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 custom-border">
				<h2 class="text-center">Main content</h2>
				<a href="test.php" class="text-center">Test Link</a>
			</div>
			<div class="col-12 col-md-4 custom-border">
				<?php include ("status.form.php"); ?>
			</div>
		</div>
	</div>
</body>
<style type="text/css">
	.custom-border {border: 1px solid black; padding-bottom: 10px; padding-top: 10px;}
</style>
</html>