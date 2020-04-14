<?php
	require "db.php";
	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$errors = array();
		$user = R::findOne( 'users', 'login = ?', array($data['login']) );
		if ( $user)
		{
			if ( $data['password'] == $user->password )
			{
				$_SESSION['logged_user'] = $user;
				header("Location: /index.php");
			} else
			{
				$errors[] = 'Password is incorrect';
			}
		} else
		{
			$errors[] = 'User not found';
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
	<div id="page">

	<form id="login" action="login.php" method="POST">
	
		
			<h2>Login</h2>
			
			<div class="login_input">
				<input type="text" name="login" class="input_login">
			</div>

		
			<h2>Password</h2>

			<div class="login_input">
				<input type="password" name="password" class="input_login">
			</div>

			<div class="login_btn">
				<button class="btn_login" type="submit" name="do_login">Login</button>
			</div>
		
			<div class="login_link">
				<a class="link_login" href="/signup.php">Sign  up</a>
			</div>
			<div class="spn">
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