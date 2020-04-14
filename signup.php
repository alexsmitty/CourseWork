<?php
	require "db.php";
	$data = $_POST;
	if ( isset($data['do_signup']) )
	{
		$errors = array();
		if ( trim($data['login']) == '' ) 
		{
			$errors[] = 'Enter login ';
		}

		if ( $data['password'] == '' ) 
		{
			$errors[] = 'Enter password ';
		}

		if ( $data['password_2'] != $data['password'] ) 
		{
			$errors[] = 'repeated password is wrong';
		}

		if ( R::count('users', "login = ?", array($data['login'])) > 0 ) 
		{
			$errors[] = ' This login is already used';
		}
		if ( empty($errors) )
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->password = $data['password'];
			R::store($user);
			header("Location: /login.php");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="assets/css/styles_php.css" />
</head>
<body>
	<div id="page2">
		<form action="/signup.php" method="POST">
			<h2>Login<h2>
			<div>
				<input  class="it" type="text" name="login">
			</div>
			<h2>Name<h2>
			<div>
				<input type="text" name="name">
			</div>
			<h2>e-mail<h2>
			<div>
				<input type="text" name="email">
			</div>
			<h2>Your password<h2>
			<div>
				<input type="text" name="password">
			</div>		
			<h2>Retype password<h2>
			<div>
				<input type="text" name="password_2">
			</div>
			<div>
				<button type="submit" name="do_signup">Sign up</button>
			</div>	
			<div>
				<?php
					if ( ! empty($errors) )
						{
							echo '<span class="login_span">'.array_shift($errors).'</span>';
						}
				?>
			</div>		
			
		</form>
	</div>
</body>
</html>

